<!DOCTYPE html>
<html>
<head>
    <title>Contract Agreement || {{$clientRecord['client_id']}}</title>
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

</body>
</html>
