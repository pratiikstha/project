<?php
class CitizensController extends AppController {

	var $name = 'Citizens';
	var $uses = array('Citizen', 'Address', 'District', 'Zone', 'Vm', 'Region', 'CitizenRelation', 'ValidRelation');
	var $helpers = array('javascript', 'Js', 'Ajax');
	var $components = array('RequestHandler');

	function beforeFilter() {
		$districts = $this->Address->District->find('list');
		$this->set(compact('districts'));
		
		$vmsNames = $this->Address->Vms->find('list');
		$this->set(compact('vmsNames'));
		
		parent::beforeFilter();
	}
	
	function index() {
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
		
		$this->Citizen->recursive = 0;
		$this->Citizen->order = 'ssn_no ASC';
		
		$this->paginate = array(
				    'Citizen'    => array('limit' => $rows, 'page' => $page) ,
		);
		
		$records = $this->paginate();
		$recordRow = array();
		foreach($records as $key => $row) {
			//$temp['p_address'] = $this->getAddressById($row['Citizen']['permanent_address']);
			$temp['citizenship_no'] = $row['Citizen']['citizenship_no'];
			$temp['first_name'] = $row['Citizen']['first_name'];
			$temp['last_name'] = $row['Citizen']['last_name'];
			if ($row['Citizen']['birth_date'] != '') {
				//$temp['birth_date'] = $this->NepaliCalendar->convertToNepaliDate($row['Citizen']['birth_date']);
			} else {
				//$temp['birth_date'] = '';
			}
			$recordRow[] = $temp;
		}
		//exit;
		$CitizenArray = array();
		$CitizenArray['total'] = $this->Citizen->find('count');
		$CitizenArray['rows']  = $recordRow;
		
		$this->set('citizens', $recordRow);
	}

	function getAddressById($addressId) {
		$address =  $this->Address->find('first', array('conditions' => array('address_id' => $addressId)));
		//pr($address);
		if(count($address) > 0) {
			if($address['Address']['vms_options'] == 'VDC') {
				$vmsOpt = VDCS;
			} elseif ($address['Address']['vms_options'] == 'Municipality') {
				$vmsOpt = MUNICIPALITY;
			} else if($address['Address']['vms_options'] == 'Metropolitan City') {
				$vmsOpt = METROPOLITAN;
			} else {
				$vmsOpt = SUBMETROPOLITAN;
			}
			$addressStr = $address['Vms']['vms_name'] . ' ' . $vmsOpt;
			$addressStr .= ', ' . $address['District']['district_name'];
		} else {
			$addressStr = '';
		}
		return $addressStr;
	}
	
	function indexJson() {
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
		
		$this->Citizen->recursive = 0;
		$this->Citizen->order = 'ssn_no ASC';
		
		$this->paginate = array(
				    'Citizen'    => array('limit' => $rows, 'page' => $page) ,
		);
		
		$this->layout = '';
		
		$records = $this->paginate();
		$recordRow = array();
		foreach($records as $key => $row) {
			//print_r($row['Citizen']);
			$temp['citizenship_no'] = $row['Citizen']['citizenship_no'];
			$temp['first_name'] = $row['Citizen']['first_name'];
			$temp['last_name'] = $row['Citizen']['last_name'];
			if ($row['Citizen']['birth_date'] != '') {
				//$temp['birth_date'] = $this->NepaliCalendar->convertToNepaliDate($row['Citizen']['birth_date']);
			} 
			$recordRow[] = $temp;
		}
		//exit;
		$CitizenArray = array();
		$CitizenArray['total'] = $this->Citizen->find('count');
		$CitizenArray['rows']  = $recordRow;
		
		print_r(json_encode($CitizenArray));
	}
	
	function temp(){
	
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid citizen', true));
			$this->redirect(array('action' => 'index'));
		}
		$citizen = $this->Citizen->read(null, $id);

		foreach($citizen as $key => $value):
			foreach ($value as $k => $val):
				if($key=='ssn_no'){
					$citizen['ssn_no'][$k]['ssn_no'] = $citizen['Citizen']['first_name'].' '.$citizen['Citizen']['last_name'];

					$relative_ssn = $citizen['ssn_no'][$k]['relative'];
					$relative = $this->CitizenRelation->query("select first_name, last_name from citizens where citizens.ssn_no = $relative_ssn");
					$citizen[$key][$k]['relative'] = $relative[0][0]['first_name'].' '.$relative[0][0]['last_name'];

					$relation = $citizen['ssn_no'][$k]['relation_id'];
					$relative = $this->ValidRelation->query("select relation_name from valid_relations where valid_relations.relation_id = $relation");
					$citizen[$key][$k]['relation_id'] = $relative[0][0]['relation_name'];
				}
			endforeach;
		endforeach;

		$permanent_address_id = $citizen['Citizen']['permanent_address'];
		$birthplace_id = $citizen['Citizen']['birth_place'];
		$permanent_address = $this->Address->read(null, $permanent_address_id);
		$district_name = $this->District->find('first', array(
				'conditions'=>array(
					'District.district_id'=>$permanent_address['Address']['district_id'],
				)
		));
		$zone_name = $this->Zone->find('first', array(
				'conditions'=>array(
					'Zone.zone_id'=>$permanent_address['Address']['zone_id'],
				)
		));
		$vms_name = $this->Vm->find('first', array(
				'conditions'=>array(
					'Vm.vms_id'=>$permanent_address['Address']['vms_id'],
				)
		));

		$permanent_address['Address']['district_id'] = $district_name['District']['district_name'];
		$permanent_address['Address']['zone_id'] = $zone_name['Zone']['zone_name'];
		$permanent_address['Address']['vms_id'] = $vms_name['Vm']['vms_name'];
		$birth_address['Address']['district_id'] = $district_name['District']['district_name'];
		$birth_address['Address']['zone_id'] = $district_name['Zone']['zone_name'];
		$birth_address['Address']['vms_id'] = $vms_name['Vm']['vms_name'];

		print_r($permanent_address);
		if($permanent_address_id!=$birthplace_id){
			$birth_address = $this->Address->read(null, $birthplace_id);

			$district_name = $this->District->find('first', array(
				'conditions'=>array(
					'District.district_id'=>$birth_address['Address']['district_id'],
				)
			));
			$zone_name = $this->Zone->find('first', array(
					'conditions'=>array(
						'Zone.zone_id'=>$birth_address['Address']['zone_id'],
					)
			));
			$vms_name = $this->Vm->find('first', array(
					'conditions'=>array(
						'Vm.vms_id'=>$birth_address['Address']['vms_id'],
					)
			));

			$birth_address['Address']['district_id'] = $district_name['District']['district_name'];
			$birth_address['Address']['zone_id'] = $district_name['Zone']['zone_name'];
			$birth_address['Address']['vms_id'] = $vms_name['Vm']['vms_name'];

			$birth_address['Address']['ward_no'] = $this->NepaliNumber->toggleNumberLang($birth_address['Address']['ward_no'], 'nepali');
			$this->set('birthaddress', $birth_address);
		} else {
			$birth_address['Address']['ward_no'] = $this->NepaliNumber->toggleNumberLang($permanent_address['Address']['ward_no'], 'nepali');
			$this->set('birthaddress', $permanent_address);
		}
		$permanent_address['Address']['ward_no'] = $this->NepaliNumber->toggleNumberLang($permanent_address['Address']['ward_no'], 'nepali');
		//print_r($permanent_address);
		$this->set('citizen', $citizen);
		$this->set('address', $permanent_address);
		/*$relative = $this->CitizenRelation->query("select first_name, last_name from citizens where citizens.ssn_no = $citizen[ssn_no][0][relative_ssn]");
		$this->set('relationby', $relation_by);
		$this->set('relative', $relative);*/
	}

	function add() {
		if (!empty($this->data)) {
			//print_r($this->data);
			/* Start Transaction */
			
			/* Save Birth place in address table and assign the ADDRESS ID in birth_place */
			//print "Birth Place";
			/*$this->data['Citizen']['birth_place'] = $this->saveAddress(
																		$this->data['Citizen']['birth_district'] ,
																		$this->data['Citizen']['birth_vms_options'],
																		$this->data['Citizen']['birth_vms_id'],
																		$this->NepaliNumber->toggleNumberLang($this->data['Citizen']['birth_ward'], 'english')
																	);
			//print "Permanent Address";
			$this->data['Citizen']['permanent_address'] = $this->saveAddress(
																		$this->data['Citizen']['permanent_district'] ,
																		$this->data['Citizen']['permanent_vms_options'],
																		$this->data['Citizen']['permanent_vms_id'],
																		$this->NepaliNumber->toggleNumberLang($this->data['Citizen']['permanent_ward'], 'english')
																		);
			
		print " \$this->saveAddress(" . 
			$this->data['Citizen']['permanent_district'] . ", ".
			$this->data['Citizen']['permanent_vms_options'] . ", ".
			$this->data['Citizen']['permanent_vms_id'] . ", ".
			$this->NepaliNumber->toggleNumberLang($this->data['Citizen']['permanent_ward'], 'english') .
			"); ";
		*/
			$this->data['Citizen']['citizenship_no'] = $this->NepaliNumber->toggleNumberLang($this->data['Citizen']['citizenship_no'], 'English');
			$this->data['Citizen']['birth_date'] = "1900-01-01";
			$this->data['Citizen']['birth_place'] = 1;
			$this->data['Citizen']['permanent_address'] = 1;
			$this->Citizen->create($this->data);
			$this->Citizen->save($this->data);
		}

		
	}

	function saveAddress($districtId, $vmsOptions, $vmsId, $wardNo) {
		$query = "select 
					districts.district_id, zones.zone_id, zones.region_id 
				  from 
				  	districts 
				  left join 
				  	zones 
				  on 
				  	(districts.zone_id = zones.zone_id) 
				  where 
				  	district_id = '$districtId' 
				  order by 
				  	districts.district_id";
		$result = $this->Citizen->query($query);
		
		$zoneId = $result[0][0]['zone_id'];
		$regionId = $result[0][0]['region_id'];
		
		$options = array(
							'conditions'=>array(
								'Address.region_id'   => $regionId,
								'Address.zone_id'     => $zoneId,
								'Address.district_id' => $districtId,
								'Address.vms_options' => $vmsOptions,
								'Address.vms_id'      => $vmsId,
								'Address.ward_no'     => $wardNo,
						    ), 
						    'fields'=>array('Address.address_id')
						  );
		$record = $this->Address->find('first', $options);
		print "RECORD" ;
		print_r($record);
		if (empty($record)) {
			print "EMPTY";
			$address = array();
			$address['Address']['region_id']   = $regionId;
			$address['Address']['zone_id']     = $zoneId;
			$address['Address']['district_id'] = $districtId;
			$address['Address']['vms_options'] = $vmsOptions;
			$address['Address']['vms_id'] 	  = $vmsId;
			$address['Address']['ward_no'] 	  = $wardNo;
			print_r($address);
			$this->Address->create($address);
			$this->Address->save($address);
			print $retID = $this->Address->getLastInsertID();
			return $retID;
		} else {
			print "NOT EMPTY";
			
			print $retID =  $record['Address']['address_id'];
			return $retID;
		}
		
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid citizen', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$address = array();
			$address['Address']['district_id'] = $this->data['Citizen']['district'];
			$address['Address']['vms_options'] = $this->data['Citizen']['vms_option'];
			$address['Address']['ward_no'] = $this->NepaliCalendar->convertNepaliNumberToEnglishNumber($this->data['Citizen']['ward_no']);
			$address['Address']['zone_id'] = $this->data['Citizen']['zone'];
			//$address['Address']['state'] = $this->data['Citizen']['state'];
			$address['Address']['vms_id'] = $this->data['Citizen']['vms_name'];
			$address['Address']['region_id'] = $this->data['Citizen']['region'];

			$address_id = $this->Address->find('first', array(
				'conditions'=>array(
					'Address.vms_options'=>$address['Address']['vms_options'],
					'Address.ward_no'=>$address['Address']['ward_no'],
					'Address.zone_id'=>$address['Address']['zone_id'],
					'Address.district_id'=>$address['Address']['district_id'],
					'Address.vms_id'=>$address['Address']['vms_id'],
					'Address.region_id'=>$address['Address']['region_id']
				),
				'fields'=>array('Address.address_id')
				));
			if($address_id['Address']['address_id']==$this->data['Citizen']['permanent_address']){
				$address['Address']['address_id'] = $this->data['Citizen']['permanent_address'];
			} else if ($address_id['Address']['address_id']!=0){
				$this->data['Citizen']['permanent_address']=$address_id['Address']['address_id'];
			} else {
				$this->Address->create($address);
				$this->Address->save($address);
				$this->data['Citizen']['permanent_address'] = $this->Address->getLastInsertID();
			}

			$address['Address']['district_id'] = $this->data['Citizen']['birthdistrict'];
			$address['Address']['vms_options'] = $this->data['Citizen']['birth_vms_option'];
			$address['Address']['ward_no'] = $this->NepaliCalendar->convertNepaliNumberToEnglishNumber($this->data['Citizen']['birth_ward_no']);
			$address['Address']['zone_id'] = $this->data['Citizen']['birthzone'];
			//$address['Address']['state'] = $this->data['Citizen']['birth_state'];
			$address['Address']['vms_id'] = $this->data['Citizen']['birth_vms_name'];
			$address['Address']['region_id'] = $this->data['Citizen']['birthregion'];

			$address_id = $this->Address->find('first', array(
				'conditions'=>array(
					'Address.vms_options'=>$address['Address']['vms_options'],
					'Address.ward_no'=>$address['Address']['ward_no'],
					'Address.zone_id'=>$address['Address']['zone_id'],
					'Address.district_id'=>$address['Address']['district_id'],
					'Address.vms_id'=>$address['Address']['vms_id'],
					'Address.region_id'=>$address['Address']['region_id']
				),
				'fields'=>array('Address.address_id')
				));
			if($address_id['Address']['address_id']==$this->data['Citizen']['birth_place']){
				$address['Address']['address_id'] = $this->data['Citizen']['birth_place'];
			} else if ($address_id['Address']['address_id']!=$this->data['Citizen']['birth_place']){
				$this->data['Citizen']['birth_place']=$address_id['Address']['address_id'];
			} else {
				$this->Address->create($address);
				$this->Address->save($address);
				$this->data['Citizen']['birth_place'] = $this->Address->getLastInsertID();
			}

			$citizen['Citizen']['citizenship_no']=$this->data['Citizen']['citizenship_no'];
			$citizen['Citizen']['permanent_address']=$this->data['Citizen']['permanent_address'];
			$citizen['Citizen']['birth_place']=$this->data['Citizen']['birth_place'];
			$citizen['Citizen']['birth_date']=$this->data['Citizen']['birth_date'];
			$citizen['Citizen']['first_name']=$this->data['Citizen']['first_name'];
			$citizen['Citizen']['last_name']=$this->data['Citizen']['last_name'];
			/*$citizen['Citizen']['rh_fingerprint']=$this->data['Citizen']['rh_fingerprint'];
			$citizen['Citizen']['lh_fingerprint']=$this->data['Citizen']['lh_fingerprint'];
			$citizen['Citizen']['signature']=$this->data['Citizen']['signature'];*/
			$citizen['Citizen']['prepared_by']=$this->data['Citizen']['prepared_by'];
			$citizen['Citizen']['verified_by']=$this->data['Citizen']['verified_by'];
			$citizen['Citizen']['issued_by']=$this->data['Citizen']['issued_by'];
			$citizen['Citizen']['issued_date']=$this->data['Citizen']['issued_date'];
			if ($this->Citizen->save($this->data)) {
				$this->Session->setFlash(__('The citizen has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The citizen could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$citizen = $this->Citizen->read(null, $id);

			$permanent_address_id = $citizen['Citizen']['permanent_address'];
			$birthplace_id = $citizen['Citizen']['birth_place'];

			$address = $this->Address->read(null, $permanent_address_id);
			$birthaddress = $this->Address->read(null, $birthplace_id);

			$zones = $this->Address->Zone->find('list');
			$this->set(compact('zones'));

			$birthzones = $this->Address->Zone->find('list');
			$this->set(compact('birthzones'));

			$districts = $this->Address->District->find('list');
			$this->set(compact('districts'));

			$birthdistricts = $this->Address->District->find('list');
			$this->set(compact('birthdistricts'));

			$regions = $this->Address->Region->find('list');
			$this->set(compact('regions'));

			$birthregions = $this->Address->Region->find('list');
			$this->set(compact('birthregions'));

			$vmses = $this->Address->Vms->find('list');
			$this->set(compact('vmses'));

			$birthvmses = $this->Address->Vms->find('list');
			$this->set(compact('birthvmses'));
			
			$address['Address']['ward_no'] = $this->NepaliCalendar->convertEngNumberToNepaliNumber($address['Address']['ward_no']);
			$birthaddress['Address']['ward_no'] = $this->NepaliCalendar->convertEngNumberToNepaliNumber($birthaddress['Address']['ward_no']);

			$this->set('address', $address);
			$this->set('birthaddress', $birthaddress);
			$this->data = $this->Citizen->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for citizen', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Citizen->delete($id)) {
			$this->Session->setFlash(__('Citizen deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Citizen was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function getZones($RegionId) {
		if($this->RequestHandler->isAjax()) { // i prefer this codeblock in appcontroller
			//$this->layout = 'ajax';
		}
		$zones = $this->Zone->find('list', array('conditions'=>array('region_id'=>$RegionId)));
		echo json_encode($zones);
	}

	function getDistricts($ZoneId) {
		if($this->RequestHandler->isAjax()) { // i prefer this codeblock in appcontroller
			//->layout = 'ajax';
		}
		$districts = $this->District->find('list', array('conditions'=>array('zone_id'=>$ZoneId)));
		echo json_encode($districts);
	}

	function getVms($VmsId) {
		if($this->RequestHandler->isAjax()) { // i prefer this codeblock in appcontroller
			//$this->layout = 'ajax';
		}
		$vms = $this->Vms->find('list', array('conditions'=>array('vms_id'=>$VmsId)));
		echo json_encode($vms);
	}
	function viewPdf($id = null) 
    {
		if (!$id) 
		{ 
			$this->Session->setFlash('Sorry, there was no property ID submitted.'); 
			$this->redirect(array('action'=>'index'), null, true); 
		} 
		Configure::write('debug',0); // Otherwise we cannot use this method while developing 
		$id = intval($id);
		$citizen = $this->Citizen->read(null, $id);
		foreach($citizen as $key => $value):
			foreach ($value as $k => $val):
				if($key=='ssn_no'){
					$citizen['ssn_no'][$k]['ssn_no'] = $citizen['Citizen']['first_name'].' '.$citizen['Citizen']['last_name'];

					$relative_ssn = $citizen['ssn_no'][$k]['relative'];
					$relative = $this->CitizenRelation->query("select first_name, last_name from citizens where citizens.ssn_no = $relative_ssn");
					$citizen[$key][$k]['relative'] = $relative[0][0]['first_name'].' '.$relative[0][0]['last_name'];

					$relation = $citizen['ssn_no'][$k]['relation_id'];
					$relative = $this->ValidRelation->query("select relation_name from valid_relations where valid_relations.relation_id = $relation");
					$citizen[$key][$k]['relation_id'] = $relative[0][0]['relation_name'];
				}
			endforeach;
		endforeach;
		if (empty($citizen)) 
		{
			$this->Session->setFlash('Sorry, there is no property with the submitted ID.'); 
			$this->redirect(array('action'=>'index'), null, true); 
		}
		$permanent_address_id = $citizen['Citizen']['permanent_address'];
		$birthplace_id = $citizen['Citizen']['birth_place'];
		$permanent_address = $this->Address->read(null, $permanent_address_id);

		$district_name = $this->District->find('first', array(
				'conditions'=>array(
					'District.district_id'=>$permanent_address['Address']['district_id'],
				)
		));
		$zone_name = $this->Zone->find('first', array(
				'conditions'=>array(
					'Zone.zone_id'=>$permanent_address['Address']['zone_id'],
				)
		));
		$vms_name = $this->Vm->find('first', array(
				'conditions'=>array(
					'Vm.vms_id'=>$permanent_address['Address']['vms_id'],
				)
		));

		$permanent_address['Address']['district_id'] = $district_name['District']['district_name'];
		$permanent_address['Address']['zone_id'] = $zone_name['Zone']['zone_name'];
		$permanent_address['Address']['vms_id'] = $vms_name['Vm']['vms_name'];
		$birth_address['Address']['district_id'] = $district_name['District']['district_name'];
		$birth_address['Address']['zone_id'] = $district_name['Zone']['zone_name'];
		$birth_address['Address']['vms_id'] = $vms_name['Vm']['vms_name'];
		if($permanent_address_id!=$birthplace_id){
			$birth_address = $this->Address->read(null, $birthplace_id);

			$district_name = $this->District->find('first', array(
				'conditions'=>array(
					'District.district_id'=>$birth_address['Address']['district_id'],
				)
			));
			$zone_name = $this->Zone->find('first', array(
					'conditions'=>array(
						'Zone.zone_id'=>$birth_address['Address']['zone_id'],
					)
			));
			$vms_name = $this->Vm->find('first', array(
					'conditions'=>array(
						'Vm.vms_id'=>$birth_address['Address']['vms_id'],
					)
			));

			$birth_address['Address']['district_id'] = $district_name['District']['district_name'];
			$birth_address['Address']['zone_id'] = $district_name['Zone']['zone_name'];
			$birth_address['Address']['vms_id'] = $vms_name['Vm']['vms_name'];

			$birth_address['Address']['ward_no'] = $this->NepaliNumber->toggleNumberLang($birth_address['Address']['ward_no'], 'nepali');
			$this->set('birthaddress', $birth_address);
		} else {
			$birth_address['Address']['ward_no'] = $this->NepaliNumber->toggleNumberLang($permanent_address['Address']['ward_no'], 'nepali');
			$this->set('birthaddress', $permanent_address);
		}
		$permanent_address['Address']['ward_no'] = $this->NepaliNumber->toggleNumberLang($permanent_address['Address']['ward_no'], 'nepali');
		
		$this->set('citizen', $citizen);
		$this->set('address', $permanent_address);
		$this->set('citizen',$citizen);

		////$this->layout = ''; //this will use the pdf.ctp layout 
		$this->render();
	}

	function checkAddress($i){
		if($i['Address']['ward_no']=='' && $i['Address']['vms_id']==''){
			throw new Exception("K hi chuteko cha.....");
		}
		return true;
	}

	function getCitizenList($ctzn = '') {
		//$this->layout = '';
		$ctzn = urldecode($ctzn);
		if($ctzn == '') {
			print_r(json_encode(array()));
		} else {
			
			$returnVal = $this->NepaliNumber->toggleNumberLang($ctzn, 'english');

			$sql = "select ssn_no, citizenship_no, first_name, last_name from citizens where citizenship_no like '$returnVal%' or first_name like '$returnVal%' or last_name like '$returnVal%'";
			
			$citizens = $this->Citizen->query($sql);
			$citizenList = array();
			foreach($citizens as $k => $v) {
				$citizen = $v[0];
				$citizen['citizenship_no'] = $this->NepaliNumber->toggleNumberLang($citizen['citizenship_no'], 'nepali');
				$citizenList[$citizen['ssn_no']] = $citizen['first_name'] . ' ' . $citizen['last_name'] . ' (ना. प्र. नं : ' . $citizen['citizenship_no'] . ')';
				
			}
			print_r(json_encode(array($citizenList)));
		}
	}
	
	function getPersonInfoBySsnNo($ssnNo) {
		$citizen = $this->Citizen->find('first', array('fields' => array('first_name', 'last_name'), 'conditions' => array('ssn_no' => $ssnNo)));
		if(count($citizen) > 0) {
			return $citizen['Citizen']['first_name'] . ' ' . $citizen['Citizen']['last_name'];
		} else {
			return "";
		}
	}
}
?>