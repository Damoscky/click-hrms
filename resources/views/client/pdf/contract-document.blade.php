<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contract Agreement || {{$clientRecord['company_name']}}</title>
    <style>
        body{
            line-height: 30px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.13;
            font-size: 50px;
            width: 100%;
            color: #000080;
        }
    </style>
</head>
<body>
    <h1 class="watermark"> <strong>Click Operations (UK) Limited</strong> </h1>
    <h2>TERMS OF BUSINESS</h2>
    <h4>TERMS OF ENGAGEMENT FOR THE SUPPLY OF TEMPORARY WORKERS</h4>
    <h4>AGREEMENT FOR THE SUPPLY OF STAFFING SERVICES</h4>
    <p>This Agreement is made on {{ \Carbon\Carbon::parse($clientRecord['created_at'])->format('j F, Y') }}</p>
    <h5>BETWEEN</h5>
    <p>
        (2) Employment Business - <strong>Click Operations (UK) Limited </strong>, a company registered in England and Wales under 
        company number 14308745 whose registered office is Building 3 Regus, 
        Leeds City West Business Park, Geldered Road, Leeds. LS12 6LBN.
    </p>
    <p>And</p>
    <p>
        (1) Client - <strong>{{$clientRecord['company_name']}}</strong>, a company registered in England and Wales under company number (______________)
         whose registered office <strong> {{$clientRecord['address']}} </strong>
    </p>
    <h4><strong>1 DEFINITIONS </strong></h4>
    <p>1.1 In these Terms of Business the following definitions apply:</p>
    <p>
        “Assignment” means the period during which the Temporary Worker is supplied to render services to the Client. 
        “Client” means the person, firm or corporate body together with any subsidiary or 
        associated company as defined by the Companies Act 1985 to whom the Temporary Worker is supplied or introduced.
    </p>
    <p>
        “The Employment Business” means <strong> Click Operations (UK) Limited </strong>, company number <strong> 14308745 </strong>.
    </p>
    <p>
        "Engagement" means the engagement, employment or use of the Temporary Worker directly by the Client or any third party or through any other 
        employment business on a permanent or temporary basis, whether under a contract of service or for services; an agency, license,
        franchise or partnership arrangement; or any other engagement; directly or through a limited company of which the Temporary Worker is an officer or employee. <br>

        "Temporary Worker" means the individual who is introduced by the Employment Business to render services to the Client. <br>
        "Transfer Fee" means the fee payable in accordance with clause 8.1.2 below and Regulation 10 of the Conduct of Employment 
        Agencies and Employment Businesses Regulations 2003. <br>
        "Relevant Period" means the later of either 14 weeks from the first day on which 
        the Temporary Worker was supplied by the Employment Business to work for the Client, 
        or 8 weeks from the day after the Temporary Worker was last supplied by the Employment Business to the Client. <br>
        "Introduction Fee" means the fee payable in accordance with clause 8.2.2 below and Regulation 10 of the Conduct of Employment Agencies and Employment Businesses Regulations 2003. <br>
        "Introduction" means (i) the Client’s interview of a Temporary Worker in person or by telephone, following the Client’s 
        instruction to the Employment Business to supply a Temporary Worker; or (ii) the passing to the Client of a 
        curriculum vitae or information which identifies the Temporary Worker; and which leads to an Engagement of that Temporary Worker. <br>
        "Remuneration" includes base salary or fees, car allowance or company car guaranteed bonus and commission earnings, allowances, inducement 
        payments, and all other payments and taxable (and, where applicable, non-taxable) emoluments payable to or receivable by the Applicant 
        for services rendered to or on behalf of the Client.
    </p>
    <p>
        1.2 Unless the context otherwise requires, references to the singular include the plural.
    </p>
    <p>
        1.3 The headings contained in these Terms are for convenience only and do not affect their interpretation.
    </p>
    <p>
        The 'first day' will be the firgt occasion on which a Temporary Worker is supplied to work for the Client or the first day of an assignment where there 
        has been more than 42 days since the end of any previous assignment.
    </p>
    <h4><strong>2 THE CONTRACT </strong></h4>
    <p>
        2.1 These Terms constitute the contract between the Employment Business and the Client for the supply of the Temporary Worker’s 
        services by the Employment Business to the Client and are deemed to be accepted by the Client by virtue of its request for, interview with or Engagement of the 
        Temporary Worker or the passing of any information about the Temporary Worker to any third party following an assignment/appointment.
    </p> <br>
    <p>
        <strong>Introduction</strong>
    </p>
    <p>
        2.2 These Terms contain the entire agreement between the parties and unless otherwise agreed in writing by a representative of the Employment Business, these Terms prevail over any Terms of Business or purchase conditions put forward by the Client. <br>

        2.3 No variation or alteration to these Terms shall be valid unless the details of such variation are agreed between the Employment Business and the Client and are set out in writing and a copy of the varied terms is given to 
        the Client stating the date on or after which such varied terms shall apply.
    </p>

    <h4><strong>3 CHARGES </strong></h4>
    <p>
        3.1 The Client <strong> ({{$clientRecord['company_name']}}) </strong> agrees to pay the hourly charges of the Employment Business.

        These charges will be those in force at the time of the Assignment and the Employment business reserves the right to review and / or 
        increase the said charges for the supply of a Temporary Worker whether during the course of an Assignment or otherwise.
        The Client will be notified of such review and / or increase as and when it happens.
        
        Any reviewed or increased charges will be payable in accordance with these Terms and Conditions.
    </p>
    <p>
        The	following sets out the hourly rates.
    </p>

    <p>
        <ul>
            <li>HCA - {{$companySetting['currency']}}{{$companySetting['standard_hca']}}/h</li>
            <li>Senior HCA - {{$companySetting['currency']}}{{$companySetting['senior_hca']}}/h</li>
            <li>RGN - {{$companySetting['currency']}}{{$companySetting['rgn']}}/h</li>
            <li>Kitchen Assistant / Chef - {{$companySetting['currency']}}{{$companySetting['kitchen_assistant']}}/h</li>
            <li>Laundary / Domestic - {{$companySetting['currency']}}{{$companySetting['laundry']}}/h</li>
            <li>Bank Holiday double pay as applicable</li>
        </ul>
    </p>
    <p>
        3.2 The charges are calculated according to the number of hours worked by the Temporary Worker (to the nearest quarter hour). 
        The charges comprise mainly the Temporary Worker’s pay but also include the Employment Business’ commission catculated as a 
        percentage of the Temporary Worker’s pay, employer’s National Insurance contributions, holiday pay in accordance with AWR, 
        Auto Enrolment pension costs and any travel, hotel or other expenses as may have been agreed with the Client or, if there is no such agreement, 
        such expenses as are reasonable. Our charge rates will change when there are changes in the Minimum Wage and Minimum Statutory Leave and to comply with 
        AWR and increases in Auto Enrolment contributions. 
        These changes are made by government and we would pass the cost of these changes on to the client.
    </p>

    <p>
        3.3 The charges are invoiced to the Client on a weekly basis and are payable within 14 days of the Employment Business' invoice. 
        The Employment Business reserves the right to charge interest on any overdue amounts at the rate of 4% of the gross fee for each month 
        (or part thereof) 
        for which the debt remains unpaid beyond the due date. Where the customer does not settle its debt with <strong> Click Operations (UK) Limited </strong> within the terms agreed, 
        <strong>Click Operations (UK) Limited</strong> has the right to remove all discounts and revert to standard tariff, for all temporary assignments 
        the discount will be deemed to be 25% of the hourly charge subject to a minimum of £2.50 per hour invoiced.
    </p>
    <p>
        3.4 There are no rebates payable in respect of the charges of the Employment Business.
    </p>

    <h4><strong>4 INFORMATION TO BE PROVIDED BY CLIENT </strong></h4>
    <p>
        4.1 The Client {{$clientRecord['company_name']}} shall provide sufficient information to the Employment Business to enable the 
        Employment Business to introduce or supply 
        Temporary Worker to a Client for the position, which the Client seeks to fill, including the following information:
    </p>
    <p>
        4.1.1 The identity of the Client and, if applicable, the nature of the Client’s business.
    </p>
    <p>
        4.1.2 the date on which the Client requires a Temporary Worker to commence work and the duration, or likely duration, of the work.
    </p>
    <p>
        4.1.3 The position which the Client seeks to fill, including the type of work a Temporary Worker in that position would be required to do, 
        the location at which and the hours during which he would be required to work and any risks to 
        health or safety known to the Client and what steps the Client has taken to prevent or control such risks.
    </p>
    <p>
        4.1.4 The experience, training, qualifications and any authorisation which the Client considers are necessary, or which are required by law, 
        or by any professional body, for a Temporary Worker to possess in order to work in the position.
    </p>
    <h4><strong>5 INFORMATION TO BE PROVIDED BY EMPLOYMENT BUSINESS </strong></h4>
    <p>
        5.1 When making an Introduction of a Temporary Worker to the Client the Employment Business shall inform the Client of the identity of the Temporary Worker (staff profile); that the Temporary Worker has the necessary or required experience, training, 
        qualifications and any authorisation required by law or a professional body to work in the Assignment.
    </p>
    <p>
        5.2 Where such information is not given in paper form or by electronic means it shall be confirmed by such means by the end of the third business day (excluding Saturday, Sunday and any public or Bank holiday) following, save where the Temporary Worker is being Introduced for an Asgignment in the same position as one tn which the Temporary Worker had previously been supplied within the previous five business days and such information has already been given to the Client.
    </p>
    <h4><strong>6 TIME SHEETS </strong></h4>
    <p>
        6.1 At the end of each week of an Assignment (or at the end of the Assignment where it is for a period of one week or less) the Client shall sign the Employment Business’ time sheet verifying the number of hours worked by the Temporary Worker during that week.
    </p>
    <p>
        6.2 Signature of the time sheet by the Client is confirmation of the number of hours worked. If the Client is unable to sign a time sheet produced for authentication by the Temporary Worker because the Client disputes the hours claimed, 
        the Client shall inform the Employment Business as soon as is reasonably practicable and shall cooperate fully and in a timely fashion with the Employment Business to enable the Employment Business to establish what hours, if any, were wormed by the Temporary Worker. 
        Failure to sign the timesheet does not absolve the Client’s obligation to pay the charges in respect of the hours worked
    </p>
    <p>
        6.3 The Client shall not be entitled to decline to sign a timesheet on the basis that he is dissatisfied with the work performed by the Temporary Worker. In cases of unsuitable work the Client should apply the provisions of clause 11.1 below.
    </p>
    <h4><strong>7 PAYMENT OF THE TEMPORARY WORKER </strong></h4>
    <p>
        7.1 The Employment Business assumes responsibility for paying the Temporary Worker and where appropriate, for the deduction and payment of National Insurance Contributions and PAYE Income Tax applicable to the Temporary Worker pursuant to sections 44-47 of the Income Tax (Earnings and Pensions) Act 2003. 
        However, this will not apply where the Temporary Worker in registered by HMRC as a registered company.
    </p>
    <h4><strong>8 TRANSFER AND INTRODUCTION FEES. </strong></h4>
    <p>
        8.1 In the event of the Engagement within the Relevant Period of a Temporary Worker supplied by the Employment Business either (1) directly by the Client or (2) by the Client pursuant to being supplied by another employment business, the Client shall be liable, to either:
    </p>
    <p>
        8.1.1 Subject to electing upon giving 14 days notice, an extended period of hire of the Temporary Worker being 26 weeks, unless otherwise agreed in writing, during which the Employment Business shall be entitled to the charges set out in clause 3.1 above for each hour the Temporary Worker is so employed or supplied;
    </p>
    <p>
        8.1.2 A Transfer Fee calculated according to the accompanying Scale of Fees as set out in the schedule to these Terms, on the Remuneration payable by the Client to the Temporary Worker concerned during the first 12 months of the Engagement or, if the actual amount of the Remuneration is not known, the hourly charges referred to in clause 3.1 multiplied by 300. No refund of the Transfer Fee will be paid in the event that the Engagement subsequently terminates.
    </p>
    <p>
        8.2 In the event that there is an Introduction of a Temporary Worker to the Client which does not result in the supply of that Temporary Worker by the Employment Business to the Client, but which leads to an Engagement of the Temporary Worker by the Client either directly or pursuant to being supplied by another employment business the Client shall be liable, to either
    </p>
    <p>
        8.2.1 Subject to electing upon giving 14 day notice, a period of hire of the Temporary Worker being 26 weeks, unless agreed otherwise in writing during which the Employment Business shall be entitled to the charges set out in clause 3.1 above for each hour the Temporary Worker is so employed or supplied; and this in practical terms amounts to payment of £1500.00 to <strong> Click Operations (UK) Limited </strong>.
    </p>
    <p>
        8.2.2 An Introduction Fee calculated according to the accompanying Scale of Fees set out in the schedule to these Terms, on the Remuneration payable by the Client to Click Operations (UK) Limited, Leeds, LS12 6LN. The Temporary Worker concerned during the first 12 months of the Engagement or, if the actual amount of the Remuneration is not known, the hourly charges refeired to in clause 3.1 multiplied by 300. No refund of the Introduction Fee will be paid in the event that the Engagement subsequently terminates
    </p>
    <p>
        8.3 In the event that the Engagement of the Temporary Worker is for a fixed term of less than 12 months, the fee in clause 8.1.2 or 8.2.2, calculated as a percentage of the Remuneration, will apply pro-rata. If the Engagement is extended beyond the initial fixed term or if the Client re- engages the Temporary Worker within 6 months of the termination of the first Engagement the Client shall be liable to pay a further fee based on the additional Remuneration applicable for the period of Engagement following the initial fixed term up to the termination of the second Engagement or the first anniversary of its commencement, whichever is sooner.
    </p>
    <p>
        8.4 In the event that the Temporary Worker is introduced by the Client to a third party which results in the Engagement of the Temporary Worker by the third party within the Relevant Period the Client shall be liable to pay a Transfer Fee calculated according to the accompanying
        Scale of Fees, as set out in the schedule to these Terms, on the Remuneration payable by the Client to the Temporary Worker concerned during the first 12 months of the Engagement or, if the actual amount of the Remuneration is not known, the hourly charges referred to in clause
        3.1 multiplied by 300. No refund of the Transfer Fee will be paid in the event that the Engagement subsequently terminates.
    </p>
    <h4><strong>9 LIABILITY </strong></h4>
    <p>
        9.1 Whilst every effort is made by the Employment Business to give satisfaction to the Client by ensuring reasonable standards of skills, integrity and reliability from Temporary Workers and further to provide them in accordance with the Client’s booking details, the Employment Business is not liable for any loss, expense, damage or delay arising from any failure to provide any Temporary Worker for all or part of the period of booking or from the negligence, dishonesty, misconduct or lack of skill of the Temporary Worker. For the avoidance of doubt, the Employment Business does not exclude liability for death or personal injury arising from its own negligence.
    </p>
    <p>
        9.2 Client is ordinarily subject in respect of the Client’s own staff (excluding the matters specifically mentioned in Clause 7 above), including in particular the provision of adequate Employer’s and Public Liability Insurance cover for the Temporary Worker during all Assignments.
    </p>
    <p>
        9.3 The Client shall advise the Employment Business of any special health and safety matters about which the Employment Business is required to inform the Temporary Worker and about
        any requirements imposed by law or by any professional body which must be satisfied if the Temporary Worker is to fill the Assignment. The Client will assist the Employment Business 
        in complying with the Employment Business’ duties under the Working Time Regulations by supplying any relevant information about the Assignment requested by the Employment Business and the
         Client will not do anything to cause the Employment Business to be in breach of its obligations under these Regulations. Where the Client requires or may require the services of a Temporary Worker for more than 48 hours in any week, the Client must notify the Employment Business of this requirement before the commencement of that week.
    </p>
    <p>
        9.4 The Client undertakes that it knows of no reason why it would be detrimental to the interests of the Temporary Worker for the Temporary Worker to fill the Assignment.
    </p>
    <p>
        9.5 The Client shall indemnify and keep indemnified the Employment Business against any costs, claims or liabilities incurred by the Employment Business arising out of any Assignment or arising out of any noncompliance with clauses 9.2 and 9.3 and/or as a result of any breach of these Terms by the Client.
    </p>
    <h4><strong>10 SPECIAL SITUATIONS </strong></h4>
    <p>
        10.1 Where the Temporary Worker is required by law, or any professional body to have any qualifications or authorisations to work on the Assignment or the Assignment involves caring for or attending one or more persons under the age of eighteen or any person who by reason of age, infirmity or who is otherwise in need of care, the Employment Business will take all reasonably practicable steps to obtain and offer to provide copies of any relevant qualifications or authorisations of the Temporary Worker, two references from persons not related to the Temporary Worker who have agreed that the references they provide may be disclosed to the Client and has taken all reasonably practicable steps to confirm that the Temporary Worker is

        suitable for the Assignment. If the Employment Business is unable to do any of the above it shall inform the Client of the steps it has taken to obtain this information in any event.
    </p>
    <p>
        10.2 For the avoidance of doubt, a fee will be due from the client if the agencies own Staffs are directly or indirectly introduced to the client by virtue of their employment with the agency, this fee will be calculated at 50% of the 
        first year’s salary with the client and will not be subject to any refund unless expressly agreed in writing before the placement date.
    </p>
    <h4><strong>11 TERMINATION </strong></h4>
    <p>
        11.1 The Client undertakes to supervise the Temporary Worker sufficiently to ensure the Client’s satisfaction with the Temporary Worker’s standards of workmanship. If the Client reasonably considers that the services of the Temporary Worker are unsatisfactory, the Client may terminate the Assignment either by instructing the Temporary Worker to leave the Assignment immediately, or by directing the Employment Business to remove the Temporary Worker. The Employment Business may, in such circumstances, reduce or cancel the charges for the time worked by that Temporary Worker, provided that the Assignment terminates:
    </p>
    <p>
        11.1.1 Within four hours of the Temporary Worker commencing the Assignment where the booking is for more than seven hours; or
    </p>
    <p>
        11.1.2 Within two hours for bookings of seven hours or less; And also provided that notification of the unsuitability of the Temporary Worker is confirmed in writing to the Employment Business within 48 hours of the termination of the Assignment.
    </p>
    <p>
        11.2 Any of the Client, the Employment Business or the Temporary Worker may terminate an Assignment at any time without prior notice and without liability.
    </p>
    <p>
        11.3 The Client shall notify the Employment Business immediately and without delay and in any event within 24 hours if the Temporary Worker fails to attend work or notifies the Client that the Temporary Worker is unable to attend work for any reason.
    </p>
    <p>
        11.4 The Employment Business shall notify the Client immediately if it receives or otherwise obtains information which gives it reasonable grounds to believe that a Temporary Worker supplied to the Client is unsuitable for the Assignment and shall terminate the Assignment under the provisions of clause 11.2
    </p>
    <h4><strong>12 LAW </strong></h4>
    <p>
        12.1 These Terms are governed by the law of England & Wales and are subject to the exclusive jurisdiction of the England & Wales.
    </p> <br>
    <p>
        I confirm that the information supplied to <strong> Click Operations (UK) Limited </strong> may be used for Recruitment and Consulting purposes under the Data Protection Act and that <strong> Click Operations (UK) Limited </strong> can advertise vacancies on my behalf.
    </p>

    <div class="row">
        <div class="col-sm-6" style="float: left;">
            <h4><strong> Click Operations (UK) Limited </strong></h4>
            <p>
                Signed by: <strong> Olalekan Ayuba </strong> <br>
                <img src="{{ public_path("assets/img/clickhrm-logo.png") }}" alt="" style="width: 140px; height: 70px;">
            </p>
            <p>
                Date: {{ \Carbon\Carbon::parse($clientRecord['created_at'])->format('j F, Y') }} <br>
                Position: <strong>Director</strong>
            </p>
            <p>
                On behalf of: <strong> Click Operations (UK) Limited </strong>
            </p>
        </div>
        <div class="col-sm-6" style="float: right;">
            <h4><strong> {{$clientRecord['company_name']}} </strong></h4>
            <p>
                Signed by: <strong> _______________ </strong> <br>

            </p> <br>
            <p>
                Date: ______________ <br>
                Position: ____________
            </p>
            <p>
                On behalf of: <strong>{{$clientRecord['company_name']}}</strong>
            </p>
        </div>
    </div>



</body>
</html>
