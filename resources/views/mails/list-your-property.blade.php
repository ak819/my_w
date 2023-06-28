<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome to Home Jordan</title>
    <style type="text/css">
        body {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
            -webkit-font-smoothing: antialiased !important;
        }

        .tableContent img {
            border: 0 !important;
            display: block !important;
            outline: none !important;
        }

        a {
            color: #382F2E;
        }

        p, h1, h2, h3, h4, h5, h6 {
            color: #626262;
            padding: 0 30px 0 30px;
            margin: 8px 0 8px 0;
        }

        p {
            text-align: left;
            color: #626262;
            font-size: 16px;
            font-weight: normal;
            line-height: 25px;
            padding: 0 30px 0 30px;
        }

        ul, li {
            text-align: left;
            color: #6e6e6e;
            font-size: 14px;
            font-weight: normal;
            line-height: 19px;
        }

        a.link1 {
            color: #382F2E;
        }

        a.link2 {
            font-size: 16px;
            text-decoration: none;
            color: #ffffff;
        }

        h2 {
            text-align: left;
            color: #222222;
            font-size: 19px;
            font-weight: normal;
        }

        div, p, ul, h1 {
            margin: 0;
        }

        @media only screen and (max-width:480px) {

            table[class="MainContainer"], td[class="cell"] {
                width: 100% !important;
                height: auto !important;
            }

            td[class="specbundle"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
                padding-bottom: 15px !important;
            }

            td[class="spechide"] {
                display: none !important;
            }

            img[class="banner"] {
                width: 100% !important;
                height: auto !important;
            }

            td[class="left_pad"] {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }

        @media only screen and (max-width:540px) {

            table[class="MainContainer"], td[class="cell"] {
                width: 100% !important;
                height: auto !important;
            }

            td[class="specbundle"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
                padding-bottom: 15px !important;
            }

            td[class="spechide"] {
                display: none !important;
            }

            img[class="banner"] {
                width: 100% !important;
                height: auto !important;
            }
        }
    </style>
</head>
<body paddingwidth="0" paddingheight="0" style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
    <table bgcolor="#f9f9f9" width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent" align="center" style='font-family:Helvetica, Arial,serif;'>
        <tbody>
            <tr>
                <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" class="MainContainer">
                        <tbody>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <!-- =============================== Header ====================================== -->
                                                            <tr>
                                                                <td height='0' class="spechide"></td>
                                                                <!-- =============================== Body ====================================== -->
                                                            </tr>
                                                            <tr>
                                                                <td valign='top'>
                                                                    <div style="border: 0px; padding-top: 0px; position: relative;">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <!--<tr>
                                                                                    <td height="35"></td>
                                                                                </tr>-->
                                                                                <tr>
                                                                                    <td>
                                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="10">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center" style="background-color:#ffffff; width:100%;">
                                                                                                        <img src="{{asset('images/logo.png')}}" width="40%" style="padding:2px;"/>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div style="border: 0px; padding-top: 0px; position: relative;">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                                                            <tr><td height='25'></td></tr>
                                                                            <tr>
                                                                                <td align='left'>
                                                                                    <p>
																						<strong>Hi Team,</strong><br/><br/>
                                                                                        You have received an enquiry from list your property page. Following are the details of the user:<br /><br />
                                                                                        <strong>Name:</strong> {{ $data['name'] }}<br />
                                                                                        <strong>Mobile No:</strong> {{ $data['phone'] }}<br />
                                                                                        <strong>Email Id:</strong> {{ $data['email'] }}<br />
                                                                                        <strong>Message:</strong> {{ $data['message'] }}<br />
                                                                                       
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align='left'>
                                                                                    <div class="contentEditableContainer contentTextEditable">
                                                                                        <div class="contentEditable">
                                                                                            <p>
                                                                                                <br />
                                                                                                Cheers,<br />Team Homes.
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr><td height='20'></td></tr>
                                                                        </table>
                                                                    </div>
                                                                    <div style="border: 0px; padding-top: 0px; position: relative;">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height='15'></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                    <!-- =============================== footer ====================================== -->
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
    <!--Default Zone End-->
</body>
</html>
