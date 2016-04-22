<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">
<head style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">
<!-- If you delete this tag, the sky will fall on your head -->
<meta name="viewport" content="width=device-width" style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">
<title style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">Visa Guide</title>
<link href="http://fonts.googleapis.com/css?family=Clicker+Script" rel="stylesheet" type="text/css" style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic" rel="stylesheet" type="text/css" style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;">

</head>
 
<body style="margin: 0;padding: 0;border-spacing: 0;font-family: 'Lato', sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;background-color: #fff;width: 100%!important;">

<?php
    $host = Config::get('app.url');
    $forms = $datas['forms'];
    $embassies = $datas['embassies'];
    $links = $datas['links'];
    $visa_request = $datas['visa_request'];
    $visa_on_arrival_country = $datas['visa_on_arrival_country'];
    $user = $datas['user'];
    $visa_free_countries = $datas['visa_free_countries'];
?>

    <table class="head-wrap" style="margin: 0;padding: 27px 10px;font-family: 'Open Sans', sans-serif;line-height: 1.1;color: #ffffff;width: 600px;background: #23aaa5;">
        <td style="text-align:center;font-weight:700;">
            From: <i class="in flag"></i><span class="contry-name" style="font-weight:200;">
                <?php echo $visa_request['fromCountry']['name'];?>
            </span>
            To: <i class="cn flag"></i><span class="contry-name" style="font-weight:200;">
                <?php echo $visa_request['toCountry']['name'];?>
            </span>
            Purpose: <span style="font-weight:200;"><?php echo $visa_request['purpose']['name'];?></span>
        </td>
    </table>

    <?php if (sizeof($visa_free_countries) > 0) { ?>
        <table border="0" cellspacing="0" cellpadding="0" style="margin: 0;padding: 0;" class="header" style="height: 40px;width: 100%;max-width: 600px;">    
            <tr class="image-wrapper" style="position: relative;width: 100%;height: 100%;background-size: 100%;background-image: url(https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/visa-free.jpg);">
                <td class="image-info">
                    <div class="image-wrapper visa-required" style="text-align:center;width:600px;">
                        <div class="image-info">
                            <h1 class="visa-required" style="color:white;font-family: 'FuturaStdBold', sans-serif;margin-top: 40px;">VISA FREE<br>COUNTRY</h1>
                            <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/visa-free-icon.png" style="padding:40px 10px 10px;" class="cancel">
                            <h1 class="visa-required" style="color:white;font-family: 'FuturaStdBold', sans-serif;margin-bottom: 40px;">ENJOY YOUR TRIP!</h1>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Embassies section --}}
        <?php if (sizeof($embassies) > 0) { ?>
            <table class="header-common result-header embassies" style="text-align:center;height: 60px;width: 100%;background-color:#23aaa5;max-width: 600px;padding:20px 0px;">
                <td style="color: white;text-align:center;">
                    <div style="padding:0px 0px;">
                        <div style="display:inline-block;">
                             <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/embassies.png" style="padding:0px 15px;font-family: 'FuturaStdBold', sans-serif;" class="cancel">
                        </div>
                        <div style="display: inline-block;position: relative;top: -3px;">
                            <p style="display:inline-block;font-weight:700;margin:0px;text-align:left;">SUBMIT TO <br>NEAREST EMASSY / CONSULATE</p>
                        </div>
                    </div>
                </td>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" style="margin: 0;padding: 0;">
                <tr style="margin: 0;padding: 0;line-height:1.1;">
                    <td style="margin: 0;padding: 0;line-height:1.1;">
                        <div class="content-wrapper bg-dark-violet embassy-content" style="height:400px;width:600px;text-align:center;background-color:#24202e;">
                            <?php foreach ($embassies as $embassy) {?>
                                <?php if ($embassy['closest'] == TRUE) { ?>
                                    <table class="ui celled table bg-transparent" style="width:300px;padding:40px 90px 0;margin: 0 auto;">
                                        <tbody>
                                            <?php if ($embassy['address']) { ?>
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;vertical-align: top;">Address: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <?php echo $embassy['address'];?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($embassy['phone']) { ?>    
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;">Phone: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <?php echo $embassy['phone']; ?>    
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <?php if ($embassy['email']) { ?>
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;">Email: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <?php echo $embassy['email']; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <?php if ($embassy['website']) { ?>
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;">Website: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <a href="<?php echo $embassy['website']; ?>" target="_blank" style="color: white;"><?php echo $embassy['website']; ?></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            </table>
        <?php } ?>
        {{-- End Embassies section --}}
    <?php } else { ?>
        <table border="0" cellspacing="0" cellpadding="0" style="margin: 0;padding: 0;" class="header" style="height: 40px;width: 100%;max-width: 600px;">    
            <tr class="image-wrapper" style="position: relative;width: 100%;height: 100%;background-size: 100%;background-image: url(https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/bg1.jpg);">
                <td class="image-info">
                    <div class="image-wrapper visa-required" style="text-align:center;width:600px;">
                        <div class="image-info">
                            <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/icon.png" style="padding:40px 10px 10px;" class="cancel">
                                <h1 class="visa-required" style="color:white;font-family: 'FuturaStdBold', sans-serif;">VISA REQUIRED<br>FOR THIS<br>JOURNEY</h1>
                            <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/logo.png" style="padding:10px 10px 40px;" class="cancel">
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    
        {{-- Forms section --}}
        <?php if (sizeof($forms) > 0) { ?>
            
            <table class="header-common result-header forms" style="height: 60px;width: 100%;background-color:#23aaa5;max-width: 600px;padding:20px 0px;">
                <tr style="margin: 0;padding: 0;font-family: 'Open Sans', sans-serif;line-height: 1.1;color: #393939;">
                    <td style="width:6%;padding-right:10px;">
                        <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/forms.png" style="padding-left:200px;">
                    </td>
                    <td style="color:#ffffff;font-weight:700;">
                        FILL UP THE FORMS 
                    </td>
                </tr>
            </table>
            <table class="content-wrapper bg-image" style="position: relative;text-align:center;width:600px;height:100%;padding: 60px 0px 30px;background-image: url(https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/form-bg.jpg);">
                <?php $form_links = null; 
                    foreach ($forms as $form) {
                        if ($form_links != null) {
                            $form_links = $form_links.','.$form['url'];
                        } else {
                            $form_links = $form['url'];
                        }
                    ?>
                    <tr class="max-width-400" style="width:400px;text-align:center;">
                       <td class="block margin-top-20 download-zip" style="color: #000;border-radius: 30px;width:400px;font-weight: 400;font-size: 14x!important;line-height: 19px;margin-top: 25px;"> 
                            <span class="border-bottom">
                                <a href="<?php echo $form['url'];?>"style="background: #23aaa5;width:300px;padding:10px;color: #000;border-radius: 30px;display:block;margin:10px auto;text-decoration:none;">Download <span style="font-weight: 700"><?php echo $form['name'];?></span></a>
                            </span>
                        </td>
                    </tr>
                <?php }?>
                <tr>
                    <td style="padding:20px 0px;color:#ffffff;"> 
                        <p>or <a href="<?php echo $host;?>/v1/forms?links=<?php echo $form_links;?>" style="color:#ffffff;">download all forms</a></span> as zip</p>
                    </td>
                </tr>
            </table>
        <?php } ?>
        {{-- End forms section --}}

        {{-- Links section --}}
        <?php if (sizeof($links) > 0) { ?>
            <table class="header-common result-header forms" style="height: 60px;width: 100%;background-color:#23aaa5;max-width: 600px;padding:20px 0px;">
                <tr style="margin: 0;padding: 0;font-family: 'Open Sans', sans-serif;line-height: 1.1;color: #393939;">
                    <td style="width:6%;padding-right:10px;">
                            <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/other-info.png" style="padding-left:130px;">
                    </td>
                    <td style="color:#ffffff;font-weight:700;">
                        FOR MORE HELP CHECK BELOW LINKS 
                    </td>
                </tr>
            </table>
            <table class="content-wrapper bg-image" style="position: relative;text-align:center;width:600px;height:100%;padding: 60px 0px;background-image: url(https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/form-bg.jpg);">
                <?php foreach ($links as $link) { ?>
                    <tr class="max-width-400" style="max-width:400px;text-align:center;">
                        <td class="block margin-top-20 download-zip" style="color: #000;border-radius: 30px;width:400px;font-weight: 700;font-size: 14px!important;line-height: 19px;margin-top: 25px;" data-ember-action="1815"> 
                            <span class="border-bottom">
                                <a href="<?php echo $link['url'];?>"style="background: #23aaa5;width:300px;padding:10px;color: #000;border-radius: 30px;display:block;margin:auto;text-decoration:none;"><?php echo $link['title'];?></a>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
        {{-- End Links section --}}

        {{-- Embassies section --}}
        <?php if (sizeof($embassies) > 0) { ?>
            <table class="header-common result-header embassies" style="text-align:center;height: 60px;width: 100%;background-color:#23aaa5;max-width: 600px;padding:20px 0px;">
                <td style="color: white;text-align:center;">
                    <div style="padding:0px 0px;">
                        <div style="display:inline-block;">
                             <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/embassies.png" style="padding:0px 15px;font-family: 'FuturaStdBold', sans-serif;" class="cancel">
                        </div>
                        <div style="display: inline-block;position: relative;top: -3px;">
                            <p style="display:inline-block;font-weight:700;margin:0px;text-align:left;">SUBMIT TO <br>NEAREST EMASSY / CONSULATE</p>
                        </div>
                    </div>
                </td>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" style="margin: 0;padding: 0;">
                <tr style="margin: 0;padding: 0;line-height:1.1;">
                    <td style="margin: 0;padding: 0;line-height:1.1;">
                        <div class="content-wrapper bg-dark-violet embassy-content" style="height:400px;width:600px;text-align:center;background-color:#24202e;">
                            <?php foreach ($embassies as $embassy) {?>
                                <?php if ($embassy['closest'] == TRUE) { ?>
                                    <table class="ui celled table bg-transparent" style="width:300px;padding:40px 90px 0;margin: 0 auto;">
                                        <tbody>
                                            <?php if ($embassy['address']) { ?>
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;vertical-align: top;">Address: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <?php echo $embassy['address'];?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($embassy['phone']) { ?>    
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;">Phone: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <?php echo $embassy['phone']; ?>    
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <?php if ($embassy['email']) { ?>
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;">Email: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <?php echo $embassy['email']; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <?php if ($embassy['website']) { ?>
                                                <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                    <td class="title" style="color:#ffffff;font-size: 15px;padding: 10px;">Website: </td>
                                                    <td class="content" style="color:#ffffff;font-size: 15px;padding: 10px;text-align: left;">
                                                        <a href="<?php echo $embassy['website']; ?>" target="_blank" style="color: white;"><?php echo $embassy['website']; ?></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            </table>
        <?php } ?>
        {{-- End Embassies section --}}
        
        {{-- Visa on arrival section --}}
        <?php if (sizeof($visa_on_arrival_country) > 0) { ?>
            <table class="header-common result-header forms" style="height: 60px;width: 100%;background-color:#23aaa5;max-width: 600px;padding:20px 0px;">
                            <tr style="margin: 0;padding: 0;font-family: 'Open Sans', sans-serif;line-height: 1.1;color: #393939;">
                                <td style="width:6%;padding-right:10px;">
                                    <img src="https://s3-ap-southeast-1.amazonaws.com/visa-guide-production/images/other-info.png" style="padding-left:200px;">
                                </td>
                                <td style="color:#ffffff;font-weight:700;">
                                    VISA ON ARRIVAL 
                                </td>
                            </tr>
                        </table>
            <table border="0" cellspacing="0" cellpadding="0" style="margin: 0;padding: 0;">
                <tr style="margin: 0;padding: 0;line-height:1.1;">
                    <td style="margin: 0;padding: 0;line-height:1.1;">
                        <div class="content-wrapper bg-dark-violet embassy-content" style="height:150px;width:600px;text-align:center;background-color:#3b2f80;">
                            <?php foreach ($visa_on_arrival_country as $visa_on_arrival) { ?>
                                <table class="ui celled table bg-transparent" style="width:300px;margin:0 auto;">
                                    <tbody>
                                        <?php if ($visa_on_arrival['duration']) { ?>
                                            <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                <td class="title" style="color:#ffffff;font-size: 14px;padding: 10px;">DURATION: </td>
                                                <td class="content" style="color:#ffffff;font-size: 14px;padding: 10px;">
                                                    <?php echo $visa_on_arrival['duration'];?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($visa_on_arrival['instructions']) { ?>
                                            <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                <td class="title" style="color:#ffffff;font-size: 14px;padding: 10px;">INSTRUCTIONS: </td>
                                                <td class="content" style="color:#ffffff;font-size: 14px;padding: 10px;">
                                                    <?php echo $visa_on_arrival['instructions'];?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($visa_on_arrival['fees']) { ?>
                                            <tr class="clearfix" style="display: block;border-bottom: 1px solid #4b435f;padding: 10px 0;">
                                                <td class="title" style="color:#ffffff;font-size: 14px;padding: 10px;">FEES: </td>
                                                <td class="content" style="color:#ffffff;font-size: 14px;padding: 10px;">
                                                    <?php echo $visa_on_arrival['fees'];?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            </table>
        <?php } ?>
        {{-- End Visa on arrival section --}}

    <?php } ?>

</body>
</html>