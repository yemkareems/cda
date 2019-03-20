<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Prowareness');
$pdf->SetTitle('Global Team Health Assessment');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData("gtha.png", PDF_HEADER_LOGO_WIDTH, 'Global Team Health Assessment', 'by Prowareness');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<p style="text-align: justify;">
<h1><b>THE MODEL</b></h1>


Like it or not, all teams are potentially dysfunctional. This is inevitable because they are made up of
fallible, imperfect human beings. From the basketball court to the executive suite, politics and
confusion are more the rule than the exception.
But the power of teamwork is great. The founder of a billion dollar company best expressed that
power when he once said, "If you could get all the people in an organization rowing in the same
direction, you could dominate any industry, in any market, against any competition, at any time."
Whenever a group of leaders hears this adage, they immediately nod their heads, but in a desperate
sort of way. They seem to grasp the truth of it while simultaneously surrendering to the impossibility
of actually making it happen.
Fortunately, the causes of dysfunction are both identifiable and curable. However, they don\'t die
easily. Making a team functional and cohesive requires extraordinary levels of courage and
discipline.
The following section provides an overview of the five behavioral challenges all teams must
continuously work to avoid.


<h1><b>The Five Dysfunctions</b></h1>
<b>Dysfunction #1: Absence of Trust</b><br>
<br>
This occurs when team members are reluctant to be vulnerable with one another, and are thus
unwilling to admit their mistakes, acknowledge their weaknesses or ask for help. Without a certain
comfort level among team members, a foundation of trust is impossible.
<br><br>
<b>Dysfunction #2: Fear of Conflict</b><br>
<br>
Trust is critical because without it, teams are unlikely to engage in unfiltered, passionate debate
about key issues. This creates two problems. First, stifling conflict actually increases the likelihood
of destructive, back channel sniping. Second, it leads to sub-optimal decision-making because the
team is not benefiting from the true ideas and perspectives of its members.<br>
<br><b>Dysfunction #3: Lack of Commitment</b><br>
<br>
Without conflict, it is extremely difficult for team members to truly commit to decisions because they
don\'t feel that they are part of the decision. This often creates an environment of ambiguity and
confusion in an organization, leading to frustration among employees, especially top performers.
</p>

';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

$html = '
<p style="text-align: justify;">
<br><b>Dysfunction #4: Avoidance of Accountability</b><br><br>

When teams don\'t commit to a clear plan of action, peer-to-peer accountability suffers greatly.
Even the most focused and driven individuals will hesitate to call their peers on counterproductive
actions and behaviors if they believe those actions and behaviors were never agreed upon in the
first place.
<br><br><b>Dysfunction #5: Inattention to Results</b><br><br>
When team members are not holding one another accountable, they increase the likelihood that
individual ego and recognition will become more important than collective team results. When this
occurs, the business suffers and the team starts to unravel.
The Rewards
Striving to create a functional, cohesive team is one of the few remaining competitive advantages
available to any organization looking for a powerful point of differentiation.
Functional teams get more accomplished in less time than other teams because they avoid wasting
time on the wrong issues and revisiting the same topics again and again. They also make higher
quality decisions and stick to those decisions by eliminating politics and confusion among
themselves and the people they lead. Finally, functional teams keep their best employees longer
because "A" players rarely leave organizations where they are part of, or being led by, a cohesive
team.
</p>
';


$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page


$html = '
            <table class="tblRapport">
            <thead></thead>
            <tbody>
                <tr>
                    <td rowspan="5" class="tdVertical bgOrange tdShadow">
                        <br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<p class="pTitle">Adopting <br/>& <br/>Following <br/>Scrum Practices</p>
                        <div class="sVertical">
                            <br/>G<br/>O<br/>V<br/>E<br/>R<br/>N<br/>A<br/>N<br/>C<br/>E<br/>
                        </div>
                    </td>
                    <td class="bgRed tdShadow">

                        <p class="pLevel">Level 5 </p>
                        <p class="pTitle">High Performing Team</p>
                        <p class="pGoal">Goal : Continuous improvement & Innovation</p>

                        <table border="0" style="width: 100%;height: 300px;" class="pLevel">
                            <tr style="font-size: 9px;">
                                <td>Entrepreneurial mindset</td>
                                <td>Continuous improvement</td>
                                <td>Personal Development</td>
                                <td>Constructive Conflict</td>
                            </tr>

                        </table>
                        <br/>
                    </td>
                    <td rowspan="5" class="tdVertical bgOrange tdShadow">
                        <br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<p class="pTitle">Agile <br/>& <br/>Responsive <br/>Mindset</p>
                        <div class="sVertical">
                            <br/><br/>&nbsp;<br/>C<br/>U<br/>L<br/>T<br/>U<br/>R<br/>E<br/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="bgBlue tdShadow">
                        <p class="pLevel">Level 4 </p>
                        <p class="pTitle">Self Managing Team</p>
                        <p class="pGoal">Goal : Discipline & Purpose</p>
                        <table border="0" style="width: 100%;">
                            <tr style="font-size: 8px;">
                                <td>Roles</td>
                                <td>Self Awareness</td>
                                <td>Authenticity</td>
                                <td>Rules</td>
                            </tr>
                        </table>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td class="bgGreen tdShadow">
                        <p class="pLevel">Level 3 </p>
                        <p class="pTitle">Cross-functional Team</p>
                        <p class="pGoal">Goal : Commitment & Autonomy</p>
                        <table border="0" style="width: 100%;">
                            <tr style="font-size: 8px;">
                                <td>Meetings</td>
                                <td>Reporting</td>
                                <td>Recognition</td>
                                <td>Trust</td>
                            </tr>
                        </table>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td class="bgViolet tdShadow">
                        <p class="pLevel">Level 2 </p>
                        <p class="pTitle">Engaged Team</p>
                        <p class="pGoal">Goal : Clarity & Engagement</p>
                        <table border="0" style="width: 100%;">
                            <tr style="font-size: 8px;">
                                <td>Leadership</td>
                                <td>Stakeholders</td>
                                <td>Communication</td>
                                <td>Responsibility</td>
                            </tr>
                        </table>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td class="bgPink tdShadow">
                        <p class="pLevel">Level 1 </p>
                        <p class="pTitle">Bonded Team</p>
                        <p class="pGoal">Goal : Safety & Energy</p>
                        <table border="0" style="width: 100%;">
                            <tr style="font-size: 8px;">
                                <td>Empowerment</td>
                                <td>Celebration</td>
                                <td>Commitment</td>
                                <td>Openness</td>
                            </tr>
                        </table>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="bgOrange lastRow">
                        <span class="sHorizontal"><br/>TECHNOLOGY</span>
                        <p class="pTitle">Creating an optimal virtual work environment</p>
                        <br/>
                    </td>
                </tr>
            </tbody>
        </table>


<style>

.tblRapport {
    width: 870px;
    border : 1px solid white;
}
.tblRapport tr {
    border : 1px solid white;
}
.tblRapport tr td {
    text-align: center;
    border : 1px solid white;
}
.tblRapport tr td p {
    font-family: verdana, arial, sans-serif;
}
.lastRow {
    width: 638px;
}
.pLevel {
    font-size: 11px;
}
.pTitle {
    font-size: 14px !important;
    font-weight: bold;
}
.pGoal {
    font-size: 11px;
}
.pGoal span {
    font-weight: bold;
}
.sHorizontal {
    font-size: 20px;
    font-weight: bold;
}
.sVertical {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}
.tdVertical {
    /*vertical-align: text-top;*/
}
.bgGreen {
    background-color: #2ca02c;
    color: white;
}
.bgRed {
    background-color: #d62728;
    color: white;
}
.bgBlue {
    background-color: #28a4c9;
    color: white;
}
.bgOrange {
    background-color: #e38d13;
    color: white;
    width: 20%;
}
.bgViolet {
    background-color: blueviolet;
    color: white;
}
.bgPink {
    background-color: #ff6666;
    color: white;
}
 .tdShadow {
    box-shadow: 0px 2px 5px -2px #000000;
}
</style>

';

$pdf->AddPage();
$pdf->writeHTML($html, true, false, false, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table



// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('gtha_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
