<?php 
$titleBar = "गाउँ विकास समिति";

$pageHeader = "नेपाल सरकार<br>स्थानीय विकास मन्त्रालय<br>गाउँ विकास समितिको कार्यालय<br>________ गा.वि.स.,________";
$footerText = "सर्वाधिकार : गाउँ विकास समितिको कार्यालयमा सुरक्षित ।"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $titleBar; ?> | <?php echo $title_for_layout; ?></title>
<?php
echo $this->Html->meta('icon');
echo $this->Html->css(array('boxes','reset'), null, array('media' =>'all'));

?>
<!--[if IE]> <?php echo $this->Html->css('iestyles', null, array('media' => 'all')); ?>     <![endif]-->
<!--[if lt IE 7]> <?php echo $this->Html->css('below_ie7', null, array('media' => 'all')); ?><![endif]-->
<!--[if IE 7]> <?php echo $this->Html->css('ie7.css', null, array('media' => 'all')); ?><![endif]-->

</head>
<body id="page-login" >
<div class="login-container">
        <div class="login-box">
        <?php echo $form->create(null, array('action'=>'login', 'method' =>'post', 'id' =>'loginForm'));?>
                <div class="login-form">
                    <h2>Login</h2>
                    <div id="messages">
                    <?php if (isset($is_error) && $is_error == '1') {?>
                    <ul class="messages">
						<li class="error-msg">
						<ul>
							<li>
								<span><?php echo $this->Session->flash(); ?></span>
							</li>
						</ul>
						</li>
					</ul>
					<?php  } ?>
                    </div>
                    <div class="input-box input-left"><label for="username">username</label><br />
                       <?php echo $form->text('login', array('class' => 'required-entry input-text', 'label' => false));  ?>
                    </div>
                    <div class="input-box input-right"><label for="login">password</label><br />
                    <?php echo $form->password('password', array('class' => 'required-entry input-text', 'label' => false));  ?>
					</div>
                    <div class="clear"></div>
                    <?php //echo $form->end(array('div' => array('class' => 'form-buttons'), 'class' => 'form-button', 'label' => 'Login', 'title' => 'Login'));  ?>
                    <div class="form-buttons">
                    <?php echo $form->button('Login', array('class' => 'form-button', 'label' => 'Login', 'title' => 'Login'))?>
                    </div>
                    </form>
                    
                </div>
                <p class="legal">सर्वाधिकार : गाउँ विकास समितिको कार्यालयमा सुरक्षित ।</p>
            <div class="bottom"></div>
        </div>
</div>
</body>
</html>
