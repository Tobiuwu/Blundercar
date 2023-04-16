<?php

// Disables error logging, so that there is no possibility of errors appearing to the end user
ini_set('display_errors', 0);

/** $important_details_enc: Important information about the order set by the customer */
$more_details = "";
/** $currency: Defines what appears after the postage value*/
$currency = "";
/** $product_value: Total value of products (with shipping) */
$product_value = $customer_purchase[2];

if(isset($check_purchase)){
    /** if($check_purchase[1] != "no_info"): If a purchase is made and the additional information is not the default, sets the variable $more_details
     * to show this information as a summary in the email*/
    if($check_purchase[1] != "no_info"){
        $more_details = $check_purchase[1];
    }
}

if(isset($customer_address)){
    /** $postal_code: If the address is set, add the postal code, city and country on the same line to print on the email */
    $postal_code = $customer_address[3].' '.$customer_address[4].' '.$customer_address[5];
}
/** if(isset($customer_purchase[4])): If ports are set, sets $currency and $product_value as a function of ports */
if(isset($customer_purchase[4])){
    /** if($customer_purchase[4] != "Free"): If the postage is not free, sets $currency to the euro symbol and decreases the value of the postage to the total value of the products
     * to get the value of the products without postage to show in the email. Finally, you add $currency to the postage.
     * Otherwise, since the postage is free, the total price of the products and the price after shipping will be the same. And $currency will be an empty string.
     */
    if($customer_purchase[4] != "Free"){
        $currency = "€";
        $product_value = $customer_purchase[2] - $customer_purchase[4];
        $product_value = $product_value.'€';
    } 
}

$current_date = date("Y-m-d H:i:s");

// Order Email
$message_purchase = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
        <style type="text/css" emogrify="no">
            #outlook a {
                padding: 0;
            }
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            table td {
                border-collapse: collapse;
                mso-line-height-rule: exactly;
            }
            .editable.image {
                font-size: 0 !important;
                line-height: 0 !important;
            }
            .nl2go_preheader {
                display: none !important;
                mso-hide: all !important;
                mso-line-height-rule: exactly;
                visibility: hidden !important;
                line-height: 0px !important;
                font-size: 0px !important;
            }
            body {
                width: 100% !important;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                margin: 0;
                padding: 0;
            }
            img {
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }
            a img {
                border: none;
            }
            table {
                border-collapse: collapse;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            th {
                font-weight: normal;
                text-align: left;
            }
            *[class="gmail-fix"] {
                display: none !important;
            }
        </style>
        <style type="text/css" emogrify="no">
            @media (max-width: 600px) {
                .gmx-killpill {
                    content: " \03D1";
                }
            }
        </style>
        <style type="text/css" emogrify="no">
            @media (max-width: 600px) {
                .gmx-killpill {
                    content: " \03D1";
                }
                .r0-c {
                    box-sizing: border-box !important;
                    text-align: center !important;
                    valign: top !important;
                    width: 320px !important;
                }
                .r1-o {
                    border-style: solid !important;
                    margin: 0 auto 0 auto !important;
                    width: 320px !important;
                }
                .r2-c {
                    box-sizing: border-box !important;
                    text-align: center !important;
                    valign: top !important;
                    width: 100% !important;
                }
                .r3-o {
                    border-style: solid !important;
                    margin: 0 auto 0 auto !important;
                    width: 100% !important;
                }
                .r4-i {
                    background-color: #ffffff !important;
                    padding-bottom: 20px !important;
                    padding-left: 10px !important;
                    padding-right: 10px !important;
                    padding-top: 20px !important;
                }
                .r5-c {
                    box-sizing: border-box !important;
                    display: block !important;
                    valign: top !important;
                    width: 100% !important;
                }
                .r6-o {
                    border-style: solid !important;
                    width: 100% !important;
                }
                .r7-i {
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                }
                .r8-o {
                    background-size: auto !important;
                    border-style: solid !important;
                    margin: 0 auto 0 auto !important;
                    width: 100% !important;
                }
                .r9-i {
                    padding-bottom: 15px !important;
                    padding-top: 15px !important;
                }
                .r10-c {
                    box-sizing: border-box !important;
                    text-align: left !important;
                    valign: top !important;
                    width: 100% !important;
                }
                .r11-o {
                    border-style: solid !important;
                    margin: 0 auto 0 0 !important;
                    width: 100% !important;
                }
                .r12-i {
                    padding-top: 15px !important;
                    text-align: center !important;
                }
                .r13-i {
                    padding-bottom: 15px !important;
                    padding-top: 15px !important;
                    text-align: left !important;
                }
                .r14-o {
                    border-style: solid !important;
                    margin: 0 auto 0 auto !important;
                    margin-bottom: 15px !important;
                    margin-top: 15px !important;
                    width: 100% !important;
                }
                .r15-i {
                    text-align: center !important;
                }
                .r16-r {
                    background-color: #0092ff !important;
                    border-radius: 4px !important;
                    border-width: 0px !important;
                    box-sizing: border-box;
                    height: initial !important;
                    padding-bottom: 12px !important;
                    padding-left: 5px !important;
                    padding-right: 5px !important;
                    padding-top: 12px !important;
                    text-align: center !important;
                    width: 100% !important;
                }
                .r17-i {
                    background-color: #eff2f7 !important;
                    padding-bottom: 20px !important;
                    padding-left: 15px !important;
                    padding-right: 15px !important;
                    padding-top: 20px !important;
                }
                .r18-i {
                    color: #3b3f44 !important;
                    padding-bottom: 0px !important;
                    padding-top: 15px !important;
                    text-align: center !important;
                }
                .r19-i {
                    color: #3b3f44 !important;
                    padding-bottom: 0px !important;
                    padding-top: 0px !important;
                    text-align: center !important;
                }
                .r20-i {
                    background-color: #ffffff !important;
                    padding-bottom: 20px !important;
                    padding-left: 15px !important;
                    padding-right: 15px !important;
                    padding-top: 20px !important;
                }
                .r21-c {
                    box-sizing: border-box !important;
                    text-align: center !important;
                    width: 100% !important;
                }
                .r22-i {
                    padding-bottom: 15px !important;
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                    padding-top: 0px !important;
                }
                body {
                    -webkit-text-size-adjust: none;
                }
                .nl2go-responsive-hide {
                    display: none;
                }
                .nl2go-body-table {
                    min-width: unset !important;
                }
                .mobshow {
                    height: auto !important;
                    overflow: visible !important;
                    max-height: unset !important;
                    visibility: visible !important;
                    border: none !important;
                }
                .resp-table {
                    display: inline-table !important;
                }
                .magic-resp {
                    display: table-cell !important;
                }
            }
        </style>
        <!--[if !mso]><!-->
        <style type="text/css" emogrify="no"></style>
        <!--<![endif]-->
        <style type="text/css">
            p,
            h1,
            h2,
            h3,
            h4,
            ol,
            ul {
                margin: 0;
            }
            a,
            a:link {
                color: #0092ff;
                text-decoration: underline;
            }
            .nl2go-default-textstyle {
                color: #3b3f44;
                font-family: arial, helvetica, sans-serif;
                font-size: 18px;
                line-height: 1.5;
                word-break: break-word;
            }
            .default-button {
                color: #ffffff;
                font-family: arial, helvetica, sans-serif;
                font-size: 16px;
                font-style: normal;
                font-weight: bold;
                line-height: 1.15;
                text-decoration: none;
                word-break: break-word;
            }
            .default-heading1 {
                color: #1f2d3d;
                font-family: arial, helvetica, sans-serif;
                font-size: 36px;
                word-break: break-word;
            }
            .default-heading2 {
                color: #1f2d3d;
                font-family: arial, helvetica, sans-serif;
                font-size: 32px;
                word-break: break-word;
            }
            .default-heading3 {
                color: #1f2d3d;
                font-family: arial, helvetica, sans-serif;
                font-size: 24px;
                word-break: break-word;
            }
            .default-heading4 {
                color: #1f2d3d;
                font-family: arial, helvetica, sans-serif;
                font-size: 18px;
                word-break: break-word;
            }
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: inherit !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            .no-show-for-you {
                border: none;
                display: none;
                float: none;
                font-size: 0;
                height: 0;
                line-height: 0;
                max-height: 0;
                mso-hide: all;
                overflow: hidden;
                table-layout: fixed;
                visibility: hidden;
                width: 0;
            }
        </style>
        <!--[if mso]>
            <xml>
                <o:OfficeDocumentSettings> <o:AllowPNG /> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings>
            </xml>
        <![endif]-->
        <style type="text/css">
            a:link {
                color: #0092ff;
                text-decoration: underline;
            }
        </style>
    </head>
    <body text="#3b3f44" link="#0092ff" yahoo="fix" style="">
        <table cellspacing="0" cellpadding="0" border="0" role="presentation" class="nl2go-body-table" width="100%" style="width: 100%;">
            <tr>
                <td align="center" class="r0-c">
                    <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="600" class="r1-o" style="table-layout: fixed; width: 600px;">
                        <tr>
                            <td valign="top" class="">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                    <tr>
                                        <td class="r2-c" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r3-o" style="table-layout: fixed; width: 100%;">
                                                <!-- -->
                                                <tr>
                                                    <td class="r4-i" style="background-color: #ffffff; padding-bottom: 20px; padding-top: 20px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                                            <tr>
                                                                <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                                                                    <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r6-o" style="table-layout: fixed; width: 100%;">
                                                                        <!-- -->
                                                                        <tr>
                                                                            <td valign="top" class="r7-i">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                                                                    <tr>
                                                                                        <td class="r2-c" align="center">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="210" class="r8-o" style="table-layout: fixed; width: 210px;">
                                                                                                <tr>
                                                                                                    <td class="r9-i" style="font-size: 0px; line-height: 0px; padding-bottom: 15px; padding-top: 15px;">
                                                                                                        <img
                                                                                                            src="https://img.mailinblue.com/5847199/images/content_library/original/641764ab8587fe03ed1a0630.png"
                                                                                                            width="210"
                                                                                                            border="0"
                                                                                                            class=""
                                                                                                            style="display: block; width: 100%;"
                                                                                                        />
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="r10-c" align="left">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r11-o" style="table-layout: fixed; width: 100%;">
                                                                                                <tr>
                                                                                                    <td
                                                                                                        align="center"
                                                                                                        valign="top"
                                                                                                        class="r12-i nl2go-default-textstyle"
                                                                                                        style="
                                                                                                            color: #3b3f44;
                                                                                                            font-family: arial, helvetica, sans-serif;
                                                                                                            font-size: 18px;
                                                                                                            word-break: break-word;
                                                                                                            line-height: 1.5;
                                                                                                            padding-top: 15px;
                                                                                                            text-align: center;
                                                                                                        "
                                                                                                    >
                                                                                                        <div>
                                                                                                            <h1
                                                                                                                class="default-heading1"
                                                                                                                style="margin: 0; color: #1f2d3d; font-family: arial, helvetica, sans-serif; font-size: 36px; word-break: break-word;"
                                                                                                            >
                                                                                                                <span style="font-family: 'Comic sans ms', cursive;">Thank you for using Blunder Car</span>
                                                                                                            </h1>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="r10-c" align="left">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r11-o" style="table-layout: fixed; width: 100%;">
                                                                                                <tr>
                                                                                                    <td
                                                                                                        align="left"
                                                                                                        valign="top"
                                                                                                        class="r13-i nl2go-default-textstyle"
                                                                                                        style="
                                                                                                            color: #3b3f44;
                                                                                                            font-family: arial, helvetica, sans-serif;
                                                                                                            font-size: 18px;
                                                                                                            line-height: 1.5;
                                                                                                            word-break: break-word;
                                                                                                            padding-bottom: 15px;
                                                                                                            padding-top: 15px;
                                                                                                            text-align: left;
                                                                                                        "
                                                                                                    >
                                                                                                        <div>
                                                                                                            <p style="margin: 0;">
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 15px;">
                                                                                                                    <strong>Order Number</strong>: $customer_purchase[0]
                                                                                                                </span>
                                                                                                            </p>
                                                                                                            <p style="margin: 0;">
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 15px;">
                                                                                                                    <strong>Time of purchase</strong>: $customer_purchase[3]
                                                                                                                </span>
                                                                                                            </p>
                                                                                                            <p style="margin: 0;"></p>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="r10-c" align="left">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r11-o" style="table-layout: fixed; width: 100%;">
                                                                                                <tr>
                                                                                                    <td
                                                                                                        align="left"
                                                                                                        valign="top"
                                                                                                        class="r13-i nl2go-default-textstyle"
                                                                                                        style="
                                                                                                            color: #3b3f44;
                                                                                                            font-family: arial, helvetica, sans-serif;
                                                                                                            font-size: 18px;
                                                                                                            line-height: 1.5;
                                                                                                            word-break: break-word;
                                                                                                            padding-bottom: 15px;
                                                                                                            padding-top: 15px;
                                                                                                            text-align: left;
                                                                                                        "
                                                                                                    >
                                                                                                        <div>
                                                                                                            <p style="margin: 0;"><span style="font-family: 'Comic sans ms', cursive; font-size: 20px;">More details: $more_details</span></p>
                                                                                                            <p style="margin: 0;"></p>
                                                                                                            <p style="margin: 0;">
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;">Name: $customer_address[0]</span><br />
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;"></span>
                                                                                                            </p>
                                                                                                            <p style="margin: 0;">
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;">Address: $customer_address[2]</span><br />
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;"></span>
                                                                                                            </p>
                                                                                                            <p style="margin: 0;">
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;">Postal code:$postal_code</span><br />
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;"></span>
                                                                                                            </p>
                                                                                                            <p style="margin: 0;">
                                                                                                                <span style="font-family: 'Comic sans ms', cursive; font-size: 20px;">Phone number: $customer_address[6] </span>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="r2-c" align="center">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="300" class="r14-o" style="table-layout: fixed; width: 300px;">
                                                                                                <tr class="nl2go-responsive-hide">
                                                                                                    <td height="15" style="font-size: 15px; line-height: 15px;">­</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td
                                                                                                        height="18"
                                                                                                        align="center"
                                                                                                        valign="top"
                                                                                                        class="r15-i nl2go-default-textstyle"
                                                                                                        style="color: #3b3f44; font-family: arial, helvetica, sans-serif; font-size: 18px; line-height: 1.5; word-break: break-word;"
                                                                                                    >
                                                                                                        <!--[if mso]>
                                                                                                            <v:roundrect
                                                                                                                xmlns:v="urn:schemas-microsoft-com:vml"
                                                                                                                xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                                                                href="http://blundercar.epizy.com/checkoutSuccess.php?id=$customer_purchase[0]"
                                                                                                                style="v-text-anchor: middle; height: 41px; width: 299px;"
                                                                                                                arcsize="10%"
                                                                                                                fillcolor="#0092ff"
                                                                                                                strokecolor="#0092ff"
                                                                                                                strokeweight="1px"
                                                                                                                data-btn="1"
                                                                                                            >
                                                                                                                <w:anchorlock> </w:anchorlock>
                                                                                                                <v:textbox inset="0,0,0,0">
                                                                                                                    <div style="display: none;">
                                                                                                                        <center class="default-button"><p>View order</p></center>
                                                                                                                    </div>
                                                                                                                </v:textbox>
                                                                                                            </v:roundrect>
                                                                                                        <![endif]-->
                                                                                                        <!--[if !mso]><!-- -->
                                                                                                        <a
                                                                                                            href="http://blundercar.epizy.com/checkoutSuccess.php?id=$customer_purchase[0]"
                                                                                                            class="r16-r default-button"
                                                                                                            target="_blank"
                                                                                                            data-btn="1"
                                                                                                            style="
                                                                                                                font-style: normal;
                                                                                                                font-weight: bold;
                                                                                                                line-height: 1.15;
                                                                                                                text-decoration: none;
                                                                                                                word-break: break-word;
                                                                                                                border-style: solid;
                                                                                                                word-wrap: break-word;
                                                                                                                display: inline-block;
                                                                                                                -webkit-text-size-adjust: none;
                                                                                                                mso-hide: all;
                                                                                                                background-color: #0092ff;
                                                                                                                border-color: #0092ff;
                                                                                                                border-radius: 4px;
                                                                                                                border-width: 0px;
                                                                                                                color: #ffffff;
                                                                                                                font-family: arial, helvetica, sans-serif;
                                                                                                                font-size: 16px;
                                                                                                                height: 18px;
                                                                                                                padding-bottom: 12px;
                                                                                                                padding-left: 5px;
                                                                                                                padding-right: 5px;
                                                                                                                padding-top: 12px;
                                                                                                                width: 290px;
                                                                                                            "
                                                                                                        >
                                                                                                            <p style="margin: 0;">View order</p>
                                                                                                        </a>
                                                                                                        <!--<![endif]-->
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr class="nl2go-responsive-hide">
                                                                                                    <td height="15" style="font-size: 15px; line-height: 15px;">­</td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="r2-c" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r3-o" style="table-layout: fixed; width: 100%;">
                                                <!-- -->
                                                <tr>
                                                    <td class="r17-i" style="background-color: #eff2f7; padding-bottom: 20px; padding-top: 20px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                                            <tr>
                                                                <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                                                                    <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r6-o" style="table-layout: fixed; width: 100%;">
                                                                        <!-- -->
                                                                        <tr>
                                                                            <td valign="top" class="r7-i" style="padding-left: 15px; padding-right: 15px;">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                                                                    <tr>
                                                                                        <td class="r10-c" align="left">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r11-o" style="table-layout: fixed; width: 100%;">
                                                                                                <tr>
                                                                                                    <td
                                                                                                        align="center"
                                                                                                        valign="top"
                                                                                                        class="r18-i nl2go-default-textstyle"
                                                                                                        style="
                                                                                                            font-family: arial, helvetica, sans-serif;
                                                                                                            word-break: break-word;
                                                                                                            color: #3b3f44;
                                                                                                            font-size: 18px;
                                                                                                            line-height: 1.5;
                                                                                                            padding-top: 15px;
                                                                                                            text-align: center;
                                                                                                        "
                                                                                                    >
                                                                                                        <div>
                                                                                                            <p style="margin: 0;"><strong>Blunder Car</strong></p>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="r10-c" align="left">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r11-o" style="table-layout: fixed; width: 100%;">
                                                                                                <tr>
                                                                                                    <td
                                                                                                        align="center"
                                                                                                        valign="top"
                                                                                                        class="r19-i nl2go-default-textstyle"
                                                                                                        style="
                                                                                                            font-family: arial, helvetica, sans-serif;
                                                                                                            word-break: break-word;
                                                                                                            color: #3b3f44;
                                                                                                            font-size: 18px;
                                                                                                            line-height: 1.5;
                                                                                                            text-align: center;
                                                                                                        "
                                                                                                    >
                                                                                                        <div><p style="margin: 0; font-size: 14px;">+11 111 111 111 Ječná 30, 120 00, Praha 2</p></div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="r2-c" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r3-o" style="table-layout: fixed; width: 100%;">
                                                <!-- -->
                                                <tr>
                                                    <td class="r20-i" style="background-color: #ffffff; padding-bottom: 20px; padding-top: 20px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                                            <tr>
                                                                <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                                                                    <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r6-o" style="table-layout: fixed; width: 100%;">
                                                                        <!-- -->
                                                                        <tr>
                                                                            <td valign="top" class="r7-i" style="padding-left: 15px; padding-right: 15px;">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                                                                    <tr>
                                                                                        <td class="r21-c" align="center">
                                                                                            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" class="r3-o" style="table-layout: fixed; width: 100%;">
                                                                                                <tr>
                                                                                                    <td valign="top" class="r22-i" style="padding-bottom: 15px;">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation"></table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
HTML;
$message_marketing = 
<<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><head><title>Thank you for subscribing to the newsletter!</title></head><body><meta charset="UTF-8" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta name="x-apple-disable-message-reformatting" />
<meta content="IE=edge" http-equiv="X-UA-Compatible" />
<meta content="telephone=no" name="format-detection" />

<!--[if (mso 16)]><style type='text/css'>     a {text-decoration: none;}     </style><![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings> </xml><![endif]-->
<style type="text/css">
#outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {    
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                font-size: 14px !important;
                line-height: 150% !important
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
                line-height: 120% !important
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
                line-height: 120% !important
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
                line-height: 120% !important
            }

            h1 a {
                font-size: 30px !important
            }

            h2 a {
                font-size: 26px !important
            }

            h3 a {
                font-size: 20px !important
            }

            .es-menu td a {
                font-size: 14px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class='gmail-fix'] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: block !important
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-left-width: 0px !important;
                border-right-width: 0px !important
            }
        }</style>
<div class="es-wrapper-color" style="background-color:#F6F6F6">
	<!--[if gte mso 9]><v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background><![endif]-->
	<table cellpadding="0" cellspacing="0" class="es-wrapper" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top" width="100%">
		<tbody>
			<tr style="border-collapse:collapse">
				<td style="padding:0;Margin:0" valign="top">
					<table align="center" cellpadding="0" cellspacing="0" class="es-content" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
						<tbody>
							<tr style="border-collapse:collapse">
								<td align="center" style="padding:0;Margin:0">
									<table align="center" cellpadding="0" cellspacing="0" class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
										<tbody>
											<tr style="border-collapse:collapse">
												<td align="left" bgcolor="#238399" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;background-color:#051037">
													<table cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;width:560px" valign="top">
																	<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="center" style="padding:0;Margin:0;font-size:0px">
																					<img alt="Blunder Car logo" height="65" src="https://img.mailinblue.com/5847199/images/content_library/original/641764ab8587fe03ed1a0630.png" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Blunder Car logo" width="92" /></td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr style="border-collapse:collapse">
												<td align="left" style="Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px;background-position:center center">
													<!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:270px' valign='top'><![endif]-->
													<table align="left" cellpadding="0" cellspacing="0" class="es-left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0;width:270px">
																	<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="left" class="es-m-txt-c" style="padding:0;Margin:0">
																					 </td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
													<!--[if mso]></td><td style='width:20px'></td><td style='width:270px' valign='top'><![endif]-->
													<table align="right" cellpadding="0" cellspacing="0" class="es-right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0;width:270px">
																	<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="right" class="es-m-txt-c" style="padding:0;Margin:0">
																					<h5 style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333">
																						</h5>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
													<!--[if mso]></td></tr></table><![endif]--></td>
											</tr>
											<tr style="border-collapse:collapse">
												<td align="left" style="padding:0;Margin:0;padding-bottom:10px">
													<table cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;width:600px" valign="top">
																	<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="center" style="padding:0;Margin:0;padding-bottom:5px;font-size:0">
																					<table border="0" cellpadding="0" cellspacing="0" height="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																						<tbody>
																							<tr style="border-collapse:collapse">
																								<td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px">
																									 </td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr style="border-collapse:collapse">
												<td align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:center top">
													<table cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;width:560px" valign="top">
																	<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="center" style="padding:0;Margin:0">
																					<h1 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333">
																						Thanks for subscribing to Blunder Car newsletter!</h1>
																				</td>
																			</tr>
																			<tr style="border-collapse:collapse">
																				<td align="center" style="Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0">
																					<table border="0" cellpadding="0" cellspacing="0" height="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="10%">
																						<tbody>
																							<tr style="border-collapse:collapse">
																								<td style="padding:0;Margin:0;border-bottom:3px solid #238399;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px">
																									 </td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			<tr style="border-collapse:collapse">
																				<td align="center" style="padding:0;Margin:0;padding-top:5px">
																					<h3 style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333">
																						You will receive an email when there's a new product or promotion!</h3>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									<table align="center" cellpadding="0" cellspacing="0" class="es-content" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
										<tbody>
											<tr style="border-collapse:collapse">
												<td align="center" style="padding:0;Margin:0">
													<table align="center" bgcolor="#ffffff" cellpadding="0" cellspacing="0" class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:10px;Margin:0;background-position:center top">
																	<table cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="center" style="padding:0;Margin:0;width:580px" valign="top">
																					<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																						<tbody>
																							<tr style="border-collapse:collapse">
																								<td align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;font-size:0">
																									<table border="0" cellpadding="0" cellspacing="0" height="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																										<tbody>
																											<tr style="border-collapse:collapse">
																												<td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px">
																													 </td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0">
																	<table cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="left" style="padding:0;Margin:0;width:600px">
																					<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																						<tbody>
																							<tr style="border-collapse:collapse">
																								<td align="center" style="padding:0;Margin:0;padding-top:40px">
																									<h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333">
																										Customer Service 24/7</h3>
																								</td>
																							</tr>
																							<tr style="border-collapse:collapse">
																								<td align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:40px">
																									<h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#333333">
																										+11 111 111 111 (Free)</h1>
																									<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica,sans-serif;line-height:21px;color:#333333">
																										Or send as a message on our website!</p>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									<table align="center" cellpadding="0" cellspacing="0" class="es-footer" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
										<tbody>
											<tr style="border-collapse:collapse">
												<td align="center" style="padding:0;Margin:0">
													<table align="center" cellpadding="0" cellspacing="0" class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#238399;width:600px">
														<tbody>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:20px;Margin:0">
																	<!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:178px' valign='top'><![endif]-->
																	<table align="left" cellpadding="0" cellspacing="0" class="es-left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="center" class="es-m-p0r es-m-p20b" style="padding:0;Margin:0;width:178px" valign="top">
																					<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																						<tbody>
																							<tr style="border-collapse:collapse">
																								<td align="center" style="padding:0;Margin:0;font-size:0px">
																									<img alt="Blunder Car logo" height="125" src="https://img.mailinblue.com/5847199/images/content_library/original/641764ab8587fe03ed1a0630.png" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Blunder Car logo" width="178" /></td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<!--[if mso]></td><td style='width:20px'></td>
<td style='width:362px' valign='top'><![endif]-->
																	<table align="right" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
																		<tbody>
																			<tr style="border-collapse:collapse">
																				<td align="left" style="padding:0;Margin:0;width:362px">
																					<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">
																						<tbody>
																							<tr style="border-collapse:collapse">
																								<td align="center" class="es-m-txt-l" style="padding:0;Margin:0;padding-bottom:10px">
																									<h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333">
																										Talk with us!</h3>
																								</td>
																							</tr>
																							<tr style="border-collapse:collapse">
																								<td align="center" class="es-m-txt-c" style="padding:0;Margin:0">
																									<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333">
																										Ječná 30, 120 00, Praha 2</p>
																									<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333">
																										+11 111 111 111</p>
																									<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333">
																										blundercarofficial@gmail.com</p>
																								</td>
																							</tr>
																							<tr style="border-collapse:collapse">
																								<td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:10px;font-size:0">
																									<table cellpadding="0" cellspacing="0" class="es-social es-table-not-adapt" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
																										<tbody>
																											<tr style="border-collapse:collapse">
																												<td align="center" style="padding:0;Margin:0;padding-right:10px" valign="top">
																													<a href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333" target="_blank"><img alt="Tw" height="32" src="https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Twitter" width="32" /></a></td>
																												<td align="center" style="padding:0;Margin:0;padding-right:10px" valign="top">
																													<a href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333" target="_blank"><img alt="Fb" height="32" src="https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Facebook" width="32" /></a></td>
																												<td align="center" style="padding:0;Margin:0" valign="top">
																													<a href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333" target="_blank"> <img alt="Ig" height="32" src="https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Instagram" width="32" /></a></td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<!--[if mso]></td></tr></table><![endif]--></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<div style="position:absolute;left:-9999px;top:-9999px">
						 </div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
HTML;
return $message = array($message_purchase, $message_marketing);

?>