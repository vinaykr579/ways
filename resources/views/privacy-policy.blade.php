@extends('layout.app')
<style>

/* ********************************************* Start Common Css ******************************************************* */

* {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

*:before,
*:after {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

select,
input,
textarea {
	-webkit-appearance: none;
}

html,
body,
div,
span,
applet,
object,
iframe,
h1,
h2,
h3,
h4,
h5,
h6,
p,
blockquote,
pre,
a,
abbr,
acronym,
address,
big,
cite,
code,
del,
dfn,
em,
img,
ins,
kbd,
q,
s,
samp,
small,
strike,
strong,
sub,
sup,
tt,
var,
b,
u,
i,
center,
dl,
dt,
dd,
ol,
ul,
li,
fieldset,
form,
label,
legend,
table,
caption,
tbody,
tfoot,
thead,
tr,
th,
td,
article,
aside,
canvas,
details,
embed,
figure,
figcaption,
footer,
header,
hgroup,
menu,
nav,
output,
ruby,
section,
summary,
time,
mark,
audio,
video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}

.clear {
	clear: both;
}

article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
menu,
nav,
section {
	display: block;
}

img.alignleft,
img.alignright,
img.aligncenter {
	margin-bottom: 1.625em;
}

h1 {
	font-size: 30px;
}

h2 {
	font-size: 33px;
	line-height: 36px;
}

h3 {
	font-size: 30px;
	line-height: 34px;
}

h4 {
	font-size: 20px;
}

h5 {
	font-size: 16px;
}

h6 {
	font-size: 14px;
}

p {
	margin: 0;
}

ul,
li,
ol {
	list-style: none;
	margin: 0;
	padding: 0;
}

a {
	color: #1982d1;
	text-decoration: none;
	cursor: pointer;
}

a:focus,
a:active,
a:hover {
	text-decoration: none;
}

:focus {
	outline: 0;
}


/* ********************************************* End Common Css ******************************************************* */

@font-face {
	font-family: 'SFUIDisplayLight';
	src: url('../fonts/SFUIDisplayLight.eot');
	src: url('../fonts/SFUIDisplayLight.eot') format('embedded-opentype'), url('../fonts/SFUIDisplayLight.woff2') format('woff2'), url('../fonts/SFUIDisplayLight.woff') format('woff'), url('../fonts/SFUIDisplayLight.ttf') format('truetype'), url('../fonts/SFUIDisplayLight.svg#SFUIDisplayLight') format('svg');
}

@font-face {
	font-family: 'SFUIDisplayRegular';
	src: url('../fonts/SFUIDisplayRegular.eot');
	src: url('../fonts/SFUIDisplayRegular.eot') format('embedded-opentype'), url('../fonts/SFUIDisplayRegular.woff2') format('woff2'), url('../fonts/SFUIDisplayRegular.woff') format('woff'), url('../fonts/SFUIDisplayRegular.ttf') format('truetype'), url('../fonts/SFUIDisplayRegular.svg#SFUIDisplayRegular') format('svg');
}

@font-face {
	font-family: 'SFUIDisplayMedium';
	src: url('../fonts/SFUIDisplayMedium.eot');
	src: url('../fonts/SFUIDisplayMedium.eot') format('embedded-opentype'), url('../fonts/SFUIDisplayMedium.woff2') format('woff2'), url('../fonts/SFUIDisplayMedium.woff') format('woff'), url('../fonts/SFUIDisplayMedium.ttf') format('truetype'), url('../fonts/SFUIDisplayMedium.svg#SFUIDisplayMedium') format('svg');
}

@font-face {
	font-family: 'SFUIDisplayBold';
	src: url('../fonts/SFUIDisplayBold.eot');
	src: url('../fonts/SFUIDisplayBold.eot') format('embedded-opentype'), url('../fonts/SFUIDisplayBold.woff2') format('woff2'), url('../fonts/SFUIDisplayBold.woff') format('woff'), url('../fonts/SFUIDisplayBold.ttf') format('truetype'), url('../fonts/SFUIDisplayBold.svg#SFUIDisplayBold') format('svg');
}

body {
	margin: 0;
	padding: 0;
	overflow-x: hidden;
	font-family: 'SFUIDisplayRegular';
}

#page-wrapper {
	float: left;
	width: 100%;
	background: #fff;
	color: #010101;
	border-top: 1px solid #000;
}
.privacy_list {
    float: left;
    width: 100%;
    margin: 0 0 40px;
}
section,
.column {
	float: left;
	width: 100%;
	position: relative;
}

.wrapper {
	margin: 0 auto;
	max-width: 1170px;
}

h2.headings {
	font-size: 24px;
	padding-bottom:0;
	color: #010101;
	font-weight: 600;
	text-align: left;
	margin: 30px 0 0;
}

.page-content p {
	font-weight: 300;
	font-size: 14px;
	padding-bottom: 20px;
	margin: 0;
}

.privacy_list ul {
	float: left;
	width: 100%;
	margin: 0;
}

.privacy_list ul li {
	float: left;
    width: 100%;
    margin: 0 0 6px;
    font-size: 14px;
    line-height: 20px;
    list-style-type: disc;
}

.privacy_list ul li ul.bullets li {
	list-style-type: disc;
	margin: 0 0 5px;
}

.privacy_list ul.bullets {
	padding: 0 0 0 17px;
}

.privacy_list h4 {
	font-size: 17px;
	padding-bottom: 11px;
	color: #010101;
	font-weight: bold;
}
.privacy_list h5 {
    font-size: 17px;
    padding-bottom: 0;
    color: #010101;
    font-weight: bold;
    margin: 0;
}
.privacy_list .d-info h4 {
    padding: 0;
    margin-bottom: 7px;
}
.page-content .notes p:last-child {
	padding: 0;
}

.page-content .notes {
	margin: 14px 0 0;
}

.privacy_list ul li h5 {
	font-family: 'SFUIDisplayBold';
	font-size: 15px;
	margin: 0;
}

.m-b {
	margin-bottom: 18px !important;
}

.privacy_list ul li:last-child {
	margin: 0 !important;
}

.page-content p:last-child {
	padding: 0;
}

.page-content a {
	color: #010101;
}
.info {
    margin: 13px 0 0px;
    float: left;
    width: 100%;
}
</style>
@section('content')
<div id="page-wrapper" class="column">
    <div class="wrapper">
        <div class="page-content">
            <h2 class="headings">Privacy policy </h2>
            <div class="privacy_list">
                <div class="info">
                    <h4>1. Introduction</h4>

                    <p>Ways (“Ways,” “we,” “our,” and/or “us”) values the privacy of individuals who use our application, websites, and related services (collectively, the “Ways Platform ”). This privacy policy (the “Privacy Policy”) explains how we collect, use, and share information from Ways users (“Users”). Beyond the Privacy Policy, your use of Ways is also subject to our Terms and Conditions located at https://www.waysapp.in/terms.</p>
                </div>
                <div class="info">
                    <h4>2. Information We Collect</h4>

                    <h5>A. Information You Provide to Us</h5>
                </div>
                <div class="d-info info">
                    <h4>Registration Information</h4>

                    <p>When you sign up for a Ways account, you give us your phone number.</p>
                </div>
                <div class="d-info info">
                    <h4>Vehicle Information</h4>

                    <p>When you make a booking your vehicle is automatically added to your Ways Account.</p>
                </div>
                <div class="d-info info">
                    <h4>Payment Method</h4>

                    <p>When you add a credit card or payment method to your Ways account, a third party that handles payments for us will receive your card information. To keep your financial data secure, we do not store full credit card information on our servers.</p>
                </div>
                <div class="d-info info">
                    <h4>Communications</h4>

                    <p>If you contact us directly, we may receive additional information about you. For example, when you contact our Customer Support Team, we will receive your name, email address, phone number, the contents of a message or attachments that you may send to us, and other information you choose to provide.</p>
                </div>
                <div class="info">
                    <h4>B. Information We Collect When You Use the Ways Platform</h4>

                    <h5>Location Information</h5>

                    <p>When you open Ways on your mobile device, we receive your location. We may also collect the precise location of your device when the app is running in the foreground or background.</p>

                    <p>If you give us permission through your device settings or Ways app, we may collect your location while the app is off to identify promotions or service updates in your area.</p>
                </div>
                <div class="info d-info">
                    <h4>Device Information</h4>

                    <p>Ways receives information from Users’ devices, including IP address, web browser type, mobile operating system version, phone carrier and manufacturer, application</p>
                </div>
                <div class="info d-info">
                    <h4>Usage Information</h4>

                    <p>To help us understand how you use the Ways Platform and to help us improve it, we automatically receive information about your interactions with the Ways Platform, like the pages or other content you view, your actions within the Ways app, and the dates and times of your visits.</p>
                </div>
                <div class="info d-info">
                    <h4>Information from Cookies and Similar Technologies</h4>

                    <p>We collect information through the use of “cookies”, tracking pixels, and similar technologies to understand how you navigate through the Ways Platform and interact with Ways advertisements, to learn what content is popular, and to save your preferences. Cookies are small text files that web servers place on your device; they are designed to store basic information and to help websites and apps recognize your browser. We may use both session cookies and persistent cookies. A session cookie disappears after you close your browser. A persistent cookie remains after you close your browser and may be accessed every time you use the Ways Platform. You should consult your web browser(s) to modify your cookie settings. Please note that if you delete or choose not to accept cookies from us, you may be missing out on certain features of the Ways Platform.</p>
                </div>
                <div class="info">
                    <h4>C. Information We Collect from Third Parties</h4>

                    <h5>Background Information on Vehicles</h5>

                    <p>Ways works with third party partners to check vehicle registration record such as publicly available information about a vehicle.</p>
                </div>
                <div class="info d-info">
                    <h4>Third Party Partners</h4>

                    <p>We may receive additional information about you, such as demographic data, payment information, or fraud detection information, from third party partners and combine it with other information that we have about you.</p>
                </div>
                <div class="info d-info">
                    <h4>Corporate Programs</h4>

                    <p>If your company or organization participates in one of our corporate programs, we may receive information about you, such as your email address, from your participating organization.</p>
                </div>
                <div class="info">
                    <h4>3. How We the Information We Collect</h4>

                    <h6>We use the information we collect from all Users to:</h6>
                    <ul class="bullets">
                        <li>Provide, improve, expand, and promote the Ways Platform;</li>

                        <li>Analyze how the Ways users uses the Ways Platform;</li>

                        <li>Communicate with you, either directly or through one of our partners, including for marketing and promotional purposes;</li>

                        <li>Personalize the Ways experience for you;</li>

                        <li>Send you text messages and push notifications;</li>

                        <li>Facilitate transactions and payments;</li>

                        <li>Provide you with customer support; and</li>

                        <li>Find and prevent fraud.</li>
                    </ul>
                </div>
                <div class="info">
                    <h4>4. How We Share the Information We Collect</h4>

                    <h5>API and Integration Partners</h5>

                    <p>If you connect to the Ways Platform through an integration with a third party service, we may share information about your use of the Ways Platform with that third party. We may share your information with our third party partners in order to receive additional information about you. We may also share your information with third party partners to create offers that may be of interest to you.</p>
                </div>
                <div class="info d-info">
                    <h4>Service Providers</h4>

                    <p>We work with third party service providers to perform services on our behalf, and we may share your information with such service providers to help us provide the Ways Platform, including all of the things described in Section 3 above.</p>
                </div>
                <div class="info d-info">
                    <h4>Corporate Partners</h4>

                    <p>If you participate in a corporate program and charge a booking to your organization’s billing method or credits, we will provide your organization’s account holder with information about your use of the Ways Platform, including booking details such as date, time, charge, lane ID and time of passage through the toll plazas.</p>
                </div>
                <div class="info d-info">
                    <h4>Other Sharing</h4>

                    <p>We may share your information with third parties in the following cases:</p>
                    <ul class="bullets">
                        <li>While negotiating or in relation to a change of corporate control such as a restructuring, merger or sale of our assets;</li>

                        <li>If a government authority requests information and we think disclosure is required or appropriate in order to comply with laws, regulations, or a legal process;</li>

                        <li>To comply with a legal requirement or process, including but not limited to, civil and criminal subpoenas, court orders or other compulsory disclosures.</li>

                        <li>If you signed up for a promotion with another User’s referral or promotion code, with your referrer to let them know about your redemption of or qualification for the promotion;</li>

                        <li>To provide information about the use of the Ways Platform to potential business partners in aggregated or de-identified form that can’t reasonably be used to identify you; and</li>

                        <li>Whenever you consent to the sharing.</li>
                    </ul>
                </div>
                <div class="info">
                    <h4>5. Your Choices</h4>

                    <h5>Push Notifications</h5>

                    <p>You can opt out of receiving push notifications through your device settings. Please note that opting out of receiving push notifications may impact your use of the Ways Platform (such as receiving a notification that your ride has arrived).</p>
                </div>
                <div class="info d-info">
                    <h4>Location Information</h4>

                    <p>You can prevent your device from sharing location information at any time through your Device’s operating system settings.</p>
                </div>
                <div class="info d-info">
                    <h4>Editing and Accessing Your Information</h4>

                    <p>You can review and edit certain account information by logging into your account. If you would like to terminate your Ways account, please contact us through our Help Center with your request. If you choose to terminate your account, we will deactivate it for you but may retain information from your account for a certain period of time and disclose it in a manner consistent with our practices under this Privacy Policy for accounts that are not closed. We also may retain information from your account to collect any fees owed, resolve disputes, troubleshoot problems, analyze usage of the Ways Platform, assist with any investigations, prevent fraud, enforce our Terms and Conditions, or take other actions as required or permitted by law.</p>
                </div>
                <div class="info">
                    <h4>6. Other</h4>

                    <h5>Data Security</h5>

                    <p>We are committed to protecting the data of the Ways users. Even though we take reasonable precautions to protect your data, no security measures can be 100% secure, and we cannot guarantee the security of your data.</p>
                </div>
                <div class="info d-info">
                    <h4>Changes to Our Privacy Policy</h4>

                    <p>We may make changes to this Privacy Policy from time to time. If we make any material changes, we will let you know through the Ways Platform, by email, or other communication. We encourage you to read this Privacy Policy periodically to stay up- to-date about our privacy practices. As long as you use the Ways Platform, you are agreeing to this Privacy Policy and any updates we make to it.</p>
                </div>
                <div class="info d-info">
                    <h4>Contact Information</h4>

                    <p>Feel free to contact us at any time with any questions or comments about this Privacy Policy, your personal information, our use and sharing practices, or your consent choices by contacting our Help Centre.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection