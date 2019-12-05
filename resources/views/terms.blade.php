@extends('layout.app')


@section('content')
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
<div id="page-wrapper" class="column">
    <div class="wrapper">
        <div class="page-content">
            <h2 class="headings">TERMS AND CONDITIONS</h2>
            <div class="privacy_list">
                <div class="info">
                    <h4>1. Contractual Relationship</h4>
					<p>These Terms of Use (“Terms”) govern the access or use by you, an individual of mobile applications, websites, content, products, and services (the “Services”) made available by Pepal Private Limited, a company incorporated under the Companies Act 1956, and having its registered office at B-3/3273, Vasant Kunj, New Delhi - 110070 (hereinafter referred to as “Pepal”).</p>
				</div>
				<div class="info">
					<h3>PLEASE READ THESE TERMS CAREFULLY BEFORE ACCESSING OR USING THE SERVICES.</h3>
					<p>Your access and use of the Services constitutes your agreement to be bound by these Terms, which establishes a contractual relationship between you and Pepal. If you do not agree to these Terms, you may not access or use the Services. These Terms expressly supersede prior agreements or arrangements with you. Pepal may immediately terminate these Terms or any Services with respect to you, or generally cease offering or deny access to the Services or any portion thereof, at any time for any reason.</p>
					<p>Supplemental terms may apply to certain Services, such as policies for a particular event, activity or promotion, and such supplemental terms will be disclosed to you in connection with the applicable Services. Supplemental terms are in addition to, and shall be deemed a part of, the Terms for the purposes of the applicable Services. Supplemental terms shall prevail over these Terms in the event of a conflict with respect to the applicable Services.</p>
					<p>Pepal may amend the Terms related to the Services from time to time. Amendments will be effective upon Pepal’s posting of such updated Terms at this location or the amended policies or supplemental terms on the applicable Service. Your continued access or use of the Services after such posting constitutes your consent to be bound by the Terms, as amended.</p>
					<p>Our collection and use of personal information in connection with the Services is as provided in Pepal’s Privacy Policy located at <a target="_blank" href="https://www.waysapp.in/privacy-policy">https://www.waysapp.in/privacy-policy.</a></p>
				</div>
				<div class="info">
					<h4>2. The Services</h4>
					<p>The Services constitute a technology platform that enables users of the Ways mobile applications and the waysapp.in website provided as part of the Services (each, an “Application”) to buy toll tickets for a vehicle for toll plazas throughout India, as more particularly described and defined in the terms of service ("TOS") relating to such Service. </p>
					<p>In addition to this Agreement and depending on the Services opted for by the User, the User shall be required to read and accept the relevant TOS for such Service, which may be updated or modified by Pepal from time to time. Such TOS shall be deemed to be a part of this Agreement and in the event of a conflict between such TOS and this Agreement, the terms of this Agreement shall prevail. </p>
					<p>Additionally, the Toll Operators may provide terms and guidelines that govern particular features, offers or the operating rules and policies applicable to each Service (for example, toll tickets). The User shall be responsible for ensuring compliance with the terms and guidelines or operating rules and policies of the Toll Operator with whom the User elects to deal, including terms and conditions set forth by Toll Operators. In the event that any of the terms, conditions and notices contained in this Agreement or the TOS conflict with the additional/other terms and guidelines specified by the Toll Operator, then the latter terms/guidelines shall prevail. </p>
					<h3>YOU ACKNOWLEDGE THAT PEPAL DOES NOT OPERATE TOLL PLAZA OR FUNCTION AS A TOLL OPERATOR AND THAT ALL SUCH TOLLING SERVICES ARE PROVIDED BY INDEPENDENT THIRD PARTY TOLL OPERATORS.</h3>
				</div>
				<div class="info">
					<h5>License</h5>
					<p>Subject to your compliance with these Terms, Pepal grants you a limited, non-exclusive, non-sublicensable, revocable, non-transferrable license to: (i) access and use the Applications on your personal device solely in connection with your use of the Services; and (ii) access and use any content, information and related materials that may be made available through the Services, in each case solely for your personal, noncommercial use. Any rights not expressly granted herein are reserved by Pepal and Pepal’s licensors.</p>
				</div>
				<div class="info">
					<h5>Restrictions</h5>
					<p>You may not: (i) remove any copyright, trademark or other proprietary notices from any portion of the Services; (ii) reproduce, modify, prepare derivative works based upon, distribute, license, lease, sell, resell, transfer, publicly display, publicly perform, transmit, stream, broadcast or otherwise exploit the Services except as expressly permitted by Pepal; (iii) decompile, reverse engineer or disassemble the Services except as may be permitted by applicable law; (iv) link to, mirror or frame any portion of the Services; (v) cause or launch any programs or scripts for the purpose of scraping, indexing, surveying, or otherwise data mining any portion of the Services or unduly burdening or hindering the operation and/or functionality of any aspect of the Services; or (vi) attempt to gain unauthorized access to or impair any aspect of the Services or its related systems or networks.</p>
				</div>
				<div class="info">
					<h5>Third Party Services and Content</h5>
					<p>The Services may be made available or accessed in connection with third party services and content (including advertising) that Pepal does not control. You acknowledge that different terms of use and privacy policies may apply to your use of such third party services and content. Pepal does not endorse such third party services and content and in no event shall Pepal be responsible or liable for any products or services of such third party providers. Additionally, Apple Inc., Google, Inc., Microsoft Corporation or BlackBerry Limited and/or their applicable international subsidiaries and affiliates will be third-party beneficiaries to this contract if you access the Services using Applications developed for Apple iOS, Android, Microsoft Windows, or Blackberry-powered mobile devices, respectively. These third party beneficiaries are not parties to this contract and are not responsible for the provision or support of the Services in any manner. Your access to the Services using these devices is subject to terms set forth in the applicable third party beneficiary’s terms of service.</p>
				</div>
				<div class="info">
					<h5>Ownership</h5>
					<p>The Services and all rights therein are and shall remain Pepal’s property or the property of Pepal’s licensors. Neither these Terms nor your use of the Services convey or grant to you any rights: (i) in or related to the Services except for the limited license granted above; or (ii) to use or reference in any manner Pepal’s company names, logos, product and service names, trademarks or services marks or those of Pepal’s licensors.</p>
				</div>
				<div class="info">
					<h4>3. Your Use of the Services</h4>
					<h5>User Accounts</h5>
					<p>In order to use most aspects of the Services, you must register for and maintain an active personal user Services account (“Account”). You must be at least 18 years of age, or the age of legal majority, to obtain an Account. Account registration requires you to submit to Pepal certain personal information, such as your mobile phone number, your name and address, as well as at least one valid payment method (either a credit card or accepted payment partner). You agree to maintain accurate, complete, and up-to-date information in your Account. Your failure to maintain accurate, complete, and up-to-date Account information, including having an invalid or expired payment method on file, may result in your inability to access and use the Services or Pepal’s termination of these Terms with you. You are responsible for all activity that occurs under your Account, and you agree to maintain the security and secrecy of your Account at all times. Unless otherwise permitted by Pepal in writing, you may only possess one Account.</p>
				</div>
				<div class="info">				
					<h5>User Requirements and Conduct</h5>
					<p>The Service is not available for use by persons under the age of 18. You may not authorize third parties to use your Account, and you may not allow persons under the age of 18 to buy toll tickets from Toll Operators unless they are accompanied by you. You may not assign or otherwise transfer your Account to any other person or entity. You agree to comply with all applicable laws when using the Services, and you may only use the Services for lawful purposes (e.g., no transport of unlawful or hazardous materials). You will not, in your use of the Services, cause nuisance, annoyance, inconvenience, or property damage, whether to the Toll Operators or any other party. In certain instances you may be asked to provide proof of ticket to access or use the Services, and you agree that you may be denied access to or use of the Services if you refuse to provide proof of ticket.</p>
				</div>
				<div class="info">				
					<h5>Text Messaging</h5>
					<p>By creating an Account, you agree that the Services may send you text (SMS) messages as part of the normal business operation of your use of the Services. You may opt-out of receiving text (SMS) messages from Pepal at any time by following the directions found at <a href="htttp://waysapp.in/SMS-unsubscribe" target="_blank">htttp://waysapp.in/SMS-unsubscribe.</a> You acknowledge that opting out of receiving text (SMS) messages may impact your use of the Services.</p>
				</div>
				<div class="info">				
					<h5>Promotional Codes</h5>
					<p>Pepal may, in Pepal’s sole discretion, create promotional codes that may be redeemed for Account credit, or other features or benefits related to the Services, subject to any additional terms that Pepal establishes on a per promotional code basis (“Promo Codes”). You agree that Promo Codes: (i) must be used for the intended audience and purpose, and in a lawful manner; (ii) may not be duplicated, sold or transferred in any manner, or made available to the general public (whether posted to a public form or otherwise), unless expressly permitted by Pepal; (iii) may be disabled by Pepal at any time for any reason without liability to Pepal; (iv) may only be used pursuant to the specific terms that Pepal establishes for such Promo Code; (v) are not valid for cash; and (vi) may expire prior to your use. Pepal reserves the right to withhold or deduct credits or other features or benefits obtained through the use of Promo Codes by you or any other user in the event that Pepal determines or believes that the use or redemption of the Promo Code was in error, fraudulent, illegal, or in violation of the applicable Promo Code terms or these Terms.</p>
				</div>
				<div class="info">				
					<h5>User Provided Content</h5>
					<p>Pepal may, in Pepal’s sole discretion, permit you from time to time to submit, upload, publish or otherwise make available to Pepal through the Services textual, audio, and/or visual content and information, including commentary and feedback related to the Services, initiation of support requests, and submission of entries for competitions and promotions (“User Content”). Any User Content provided by you remains your property. However, by providing User Content to Pepal, you grant Pepal a worldwide, perpetual, irrevocable, transferrable, royalty-free license, with the right to sublicense, to use, copy, modify, create derivative works of, distribute, publicly display, publicly perform, and otherwise exploit in any manner such User Content in all formats and distribution channels now known or hereafter devised (including in connection with the Services and Pepal’s business and on third-party sites and services), without further notice to or consent from you, and without the requirement of payment to you or any other person or entity.</p>
					<p>You represent and warrant that: (i) you either are the sole and exclusive owner of all User Content or you have all rights, licenses, consents and releases necessary to grant Pepal the license to the User Content as set forth above; and (ii) neither the User Content nor your submission, uploading, publishing or otherwise making available of such User Content nor Pepal’s use of the User Content as permitted herein will infringe, misappropriate or violate a third party’s intellectual property or proprietary rights, or rights of publicity or privacy, or result in the violation of any applicable law or regulation.</p>
					<p>You agree to not provide User Content that is defamatory, libelous, hateful, violent, obscene, pornographic, unlawful, or otherwise offensive, as determined by Pepal in its sole discretion, whether or not such material may be protected by law. Pepal may, but shall not be obligated to, review, monitor, or remove User Content, at Pepal’s sole discretion and at any time and for any reason, without notice to you.</p>
				</div>
				<div class="info">				
					<h5>Network Access and Devices</h5>
					<p>You are responsible for obtaining the data network access necessary to use the Services. Your mobile network’s data and messaging rates and fees may apply if you access or use the Services from a wireless-enabled device and you shall be responsible for such rates and fees. You are responsible for acquiring and updating compatible hardware or devices necessary to access and use the Services and Applications and any updates thereto. Pepal does not guarantee that the Services, or any portion thereof, will function on any particular hardware or devices. In addition, the Services may be subject to malfunctions and delays inherent in the use of the Internet and electronic communications.</p>
				</div>
				<div class="info">
					<h4>4. Payment</h4>
					<p>Pepal reserves the right to establish, remove and/or revise non-refundable booking fees using the Pepal’s Services obtained through the use of the Services at any time in Pepal’s sole discretion, without notice.</p>
					<p>The User shall be liable to pay all applicable toll fees, booking fees, duties, taxes, levies and assessments for availing the Pepal Services (“Charges ”). </p>
					<p>You shall also be liable to pay applicable payment gateway charges levied by payment gateway.</p>
					<p>Pepal will facilitate your payment of the applicable Charges immediately using your preferred payment method.</p>
				</div>
				<div class="info">
					<h4>5. Disclaimers; Limitation of Liability; Indemnity</h4>
					<h5>DISCLAIMER</h5>
					<h3>THE SERVICES ARE PROVIDED “AS IS” AND “AS AVAILABLE.” PEPAL DISCLAIMS ALL REPRESENTATIONS AND WARRANTIES, EXPRESS, IMPLIED OR STATUTORY, NOT EXPRESSLY SET OUT IN THESE TERMS, INCLUDING THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN ADDITION, PEPAL MAKES NO REPRESENTATION, WARRANTY, OR GUARANTEE REGARDING THE RELIABILITY, TIMELINESS, QUALITY, SUITABILITY OR AVAILABILITY OF THE SERVICES OR ANY SERVICES OR GOODS REQUESTED THROUGH THE USE OF THE SERVICES, OR THAT THE SERVICES WILL BE UNINTERRUPTED OR ERROR-FREE. PEPAL DOES NOT GUARANTEE THE QUALITY, SUITABILITY, SAFETY OF TOLLING OPERATION OR ABILITY OF TOLL OPERTORS. YOU AGREE THAT THE ENTIRE RISK ARISING OUT OF YOUR USE OF THE SERVICES, AND ANY SERVICE OR GOOD REQUESTED IN CONNECTION THEREWITH, REMAINS SOLELY WITH YOU, TO THE MAXIMUM EXTENT PERMITTED UNDER APPLICABLE LAW.</h3>
				</div>
				<div class="info">
					<h5>LIMITATION OF LIABILITY</h5>
					<h3>PEPAL SHALL NOT BE LIABLE FOR INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, PUNITIVE OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS, LOST DATA, PERSONAL INJURY OR PROPERTY DAMAGE RELATED TO, IN CONNECTION WITH, OR OTHERWISE RESULTING FROM ANY USE OF THE SERVICES, EVEN IF PEPAL HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. PEPAL SHALL NOT BE LIABLE FOR ANY DAMAGES, LIABILITY OR LOSSES ARISING OUT OF: (i) YOUR USE OF OR RELIANCE ON THE SERVICES OR YOUR INABILITY TO ACCESS OR USE THE SERVICES; OR (ii) ANY TRANSACTION OR RELATIONSHIP BETWEEN YOU AND ANY TOLL OPERATOR, EVEN IF PEPAL HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. PEPAL SHALL NOT BE LIABLE FOR DELAY OR FAILURE IN PERFORMANCE RESULTING FROM CAUSES BEYOND PEPAL’S REASONABLE CONTROL. IN NO EVENT SHALL PEPAL’S TOTAL LIABILITY TO YOU IN CONNECTION WITH THE SERVICES FOR ALL DAMAGES, LOSSES AND CAUSES OF ACTION EXCEED TOTAL AMOUNT RECEIVED FROM THE YOU FOR AVAILING THE SERVICES LESS ANY CANCELLATION, REFUND OR OTHERS CHARGES, AS MAY BE APPLICABLE. </h3>
					<h3>PEPAL’S SERVICES MAY BE USED BY YOU TO BUY TOLL TICKETS FROM TOLL OPERATORS, BUT YOU AGREE THAT PEPAL HAS NO RESPONSIBILITY OR LIABILITY TO YOU RELATED TO TOLLING SERVICES PROVIDED TO YOU BY TOLL OPERATORS OTHER THAN AS EXPRESSLY SET FORTH IN THESE TERMS.</h3>
					<h3>THE LIMITATIONS AND DISCLAIMER IN THIS SECTION 5 DO NOT PURPORT TO LIMIT LIABILITY OR ALTER YOUR RIGHTS AS A CONSUMER THAT CANNOT BE EXCLUDED UNDER APPLICABLE LAW.</h3>
				</div>
				<div class="info">
					<h5>Indemnity</h5>
					<p>You agree to indemnify and hold Pepal and its officers, directors, employees and agents harmless from any and all claims, demands, losses, liabilities, and expenses (including attorneys’ fees) arising out of or in connection with: (i) your use of the Services or services or goods obtained through your use of the Services; (ii) your breach or violation of any of these Terms; (iii) Pepal’s use of your User Content; or (iv) your violation of the rights of any third party, including Toll operators.</p>
				</div>
				<div class="info">
					<h4>6. Governing Law; Arbitration</h4>
					<p>This agreement and each TOS shall be governed by and constructed in accordance with the laws of India without reference to conflict of laws principles and disputes arising in relation hereto shall be subject to the exclusive jurisdiction of the courts of Mumbai.</p>
				</div>
				<div class="info">
					<h4>7. Other Provisions	</h4>
					<h5>Claims of Copyright Infringement</h5>
					<p>Claims of copyright infringement should be sent to Pepal’s designated agent. Please visit Pepal’s web page at <a href="https://www.wayapp.in/legal" target="_blank">https://www.wayapp.in/legal</a> for the designated address and additional information.</p>
				</div>
				<div class="info">
					<h4>Notice</h4>
					<p>Pepal may give notice by means of a general notice on the Services, via in-Application notification or electronic mail to your email address in your Account if any, or by written communication sent to your address as set forth in your Account if any. You may give notice to Pepal by written communication to Pepal’s address at B-3/3273, Vasant Kunj, New Delhi – 110070</p>
				</div>
				<div class="info">
					<h4>General</h4>
					<p>You may not assign or transfer these Terms in whole or in part without Pepal’s prior written approval. You give your approval to Pepal for it to assign or transfer these Terms in whole or in part, including to: (i) a subsidiary or affiliate; (ii) an acquirer of Pepal’s equity, business or assets; or (iii) a successor by merger. No joint venture, partnership, employment or agency relationship exists between you, Pepal or any Toll operator as a result of the contract between you and Pepal or use of the Services.</p>
					<p>If any provision of these Terms is held to be illegal, invalid or unenforceable, in whole or in part, under any law, such provision or part thereof shall to that extent be deemed not to form part of these Terms but the legality, validity and enforceability of the other provisions in these Terms shall not be affected. In that event, the parties shall replace the illegal, invalid or unenforceable provision or part thereof with a provision or part thereof that is legal, valid and enforceable and that has, to the greatest extent possible, a similar effect as the illegal, invalid or unenforceable provision or part thereof, given the contents and purpose of these Terms. These Terms constitute the entire agreement and understanding of the parties with respect to its subject matter and replaces and supersedes all prior or contemporaneous agreements or undertakings regarding such subject matter. In these Terms, the words “including” and “include” mean “including, but not limited to.”</p>
				</div>
				<div class="info">
					<h4>8. Terms of Service </h4>
					<h5>Ticket Type</h5>
					<p>Single – It allows the vehicle one trip through the toll plaza in any direction.</p>
					<p>24Hr Return – It allows the vehicle 2 trips through the toll plaza one in each direction within 24 hours. The 24 hours countdown starts when the vehicle consumes the first trip through the toll plaza.</p>
					<p>Return – It allows the vehicle 2 trips through the toll plaza one in each direction. </p>
					<p>Monthly – It allows the vehicle 50 trips through the toll plaza 25 trips in each direction in a calendar month.  The ticket shall commence in the month you consume your first trip. </p>
					<p>Any unconsumed trips shall expire at Mid Night on the last day of the month. </p>
					<p>For Non NHAI toll plaza, a monthly ticket allows the vehicle unlimited trips through the toll plaza in a calendar month. </p>
					<p>Multi Trip – It allows the vehicle a specified number of trips through the toll plaza. </p>
					<p>Pay As You Go – It allows you to pay from the prepaid ticket amount as the vehicle make trip through the toll plaza. PAYG allows you to take advantage of fare capping. </p>
					<p>Day Return – It allows the vehicle 2 trips through the toll plaza one in each direction before Midnight on the day the vehicle consumes the first trip through the toll plaza.</p>
					<p>Day Pass - It allows the vehicle unlimited trips through the toll plaza before Midnight on the day the vehicle consumes the first trip through the toll plaza.</p>
					<p>Local Pass – For NHAI toll plaza, it is a discounted monthly ticket that allows the local resident’s vehicle unlimited trips through the toll plaza in a calendar month. </p>
					<p>Local Commercial - For NHAI toll plaza, it is a discounted Single ticket that allows the local commercial vehicle one trip through the toll plaza in any direction. </p>
					<p>Please Note that Toll Operators may not offer every type of ticket at a toll plaza. </p>
				</div>
				<div class="info">
					<h5>Booking Fees</h5>
					<p>The ticket purchased are subject to a non-refundable booking fee. </p>
				</div>
				<div class="info">
					<h5>Non-Transferable</h5>
					<p>The ticket shall be valid for the vehicle’s Number Plate provided at the time of booking and is non-transferable to another vehicle in any circumstances.</p>
				</div>
				<div class="info">
					<h5>Wrong Classification</h5>
					<p>The ticket shall be invalid in case of wrong classification of the vehicle. </p>
				</div>
				<div class="info">
					<h5>Penalty</h5>
					<p>The ticket shall be invalid in case of any penalty at the toll plaza e.g. Overweight Penalty, Wrong lane Penalty etc.</p>
				</div>
				<div class="info">
					<h5>First Booked First Consumed</h5>
					<p>Tickets for a same toll plaza shall be consumed on first booked first consumed basis. In case you would like a specific ticket to be consumed first please cancel all previous ticket for that toll plaza.</p>
				</div>
				<div class="info">
					<h5>Cancellation and Refunds</h5>
					<p>You can cancel your unconsumed ticket any time without any reason. </p>
					<p>24Hr Return, Monthly, Day Return, Day Pass and Local pass cannot be cancelled after you consumed your first trip.</p>
					<p>Multi trip consumed trips shall be charged at standard toll fee in the event of cancellation.</p>
					<p>On cancellation, Pepal shall issue a credit note for the unconsumed ticket less any booking fees in your Account </p>
				</div>
				<div class="info">
					<h5>Local Pass and Local Commercial Discount</h5>
					<p>Your unconsumed tickets shall be automatically cancelled and refunded on the expiry of your local pass or local commercial discount.</p>
				</div>
				<div class="info">
					<h5>Toll Fees and Toll Fees Change </h5>
					<p>Pepal sells toll tickets on behalf on Toll Operators and does not control the toll fees.</p>
					<p>Your unconsumed tickets shall be automatically cancelled and refunded on the day of toll fees change applies.</p>
				</div>
				<div class="info"> 
					<h5>Error</h5>
					<p>In the rare event a trip is consumed even though the you didn’t make the trip through the toll plaza due to human error or a transactional malfunction, Pepal shall rectify such error provided you notify Pepal through the provision in the Application for reporting such error within 24 hours of the error occurring. </p>
				</div>
				<div class="info">
					<h5>System Failure</h5>
					<p>In the event that toll plaza system is temporarily down, any pre-booked ticket would not accepted at toll plaza during that time except on-going 24hr Return, Monthly, Day Return, Day Pass and Local Pass provided you show the steering pass on the Ways App to the operator.</p>
				</div>
			</div>
		</div>
	</div>
</div>	

@endsection