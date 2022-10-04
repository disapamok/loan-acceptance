<!--
 API Documentation HTML Template  - 1.0.1
 Copyright © 2016 Florian Nicolas
 Licensed under the MIT license.
 https://github.com/ticlekiwi/API-Documentation-HTML-Template
 !-->
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>API - Documentation</title>
    <meta name="description" content="">
    <meta name="author" content="ticlekiwi">

    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('documentation/css/hightlightjs-dark.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&family=Source+Code+Pro:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('documentation/css/style.css') }}" media="all">
    <script></script>
</head>

<body class="one-content-column-version">
    <div class="left-menu">
        <div class="content-logo">
            <div class="logo">
                <img alt="platform by Emily van den Heever from the Noun Project"
                    title="platform by Emily van den Heever from the Noun Project"
                    src="{{ asset('documentation/images/logo.png') }}" height="32" />
                <span>API Documentation</span>
            </div>
            <button class="burger-menu-icon" id="button-menu-mobile">
                <svg width="34" height="34" viewBox="0 0 100 100">
                    <path class="line line1"
                        d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058">
                    </path>
                    <path class="line line2" d="M 20,50 H 80"></path>
                    <path class="line line3"
                        d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942">
                    </path>
                </svg>
            </button>
        </div>
        <div class="mobile-menu-closer"></div>
        <div class="content-menu">
            <div class="content-infos">
                <div class="info"><b>Version:</b> 1.0.5</div>
                <div class="info"><b>Last Updated:</b> 15th Sep, 2021</div>
            </div>
            <ul>
                <li class="scroll-to-link active" data-target="content-get-started">
                    <a>Get Started</a>
                </li>
                <li class="scroll-to-link" data-target="content-get-characters">
                    <a>API Endpoints</a>
                </li>
                <li class="scroll-to-link" data-target="content-errors">
                    <a>Errors</a>
                </li>
            </ul>
        </div>
    </div>


    <div class="content-page">
        <div class="content">
            <div class="overflow-hidden content-section" id="content-get-started">
                <h1>Get started</h1>
                <p>
                    The API provides programmatic access to read loan and customer data. Retrieve loan payment schedule
                    and record data accordingly.
                </p>
                <p>
                    To use this API, you need an <strong>API key</strong>. Please contact us at <a
                        href="mailto:hi@disapamok.com">hi@disapamok.com</a> to get your own API key.
                </p>

                <h4>HEADERS <span style="color: red">THESE HEADERS MUST PARSED IN EACH API CALL</span></h4>
                <table>
                    <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Accept</td>
                            <td>application/json</td>
                            <td>(required) Request should accept json response.</td>
                        </tr>
                        <tr>
                            <td>Bearer</td>
                            <td><strong>{API key}</strong></td>
                            <td>(required) The Key you received to communicate.</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- Loans -->
            <div class="overflow-hidden content-section" id="content-get-characters">
                <h2>get loans</h2>
                <p>
                    To get loan data you need to make a POST call to the following url :<br>
                    <span class="method-post">POST</span>
                    <code class="higlighted break-word">{{ route('api.v1.loans.index') }}</code>
                </p>
            </div>
            <!-- End Loans -->

            <!-- Add New Loan -->
            <div class="overflow-hidden content-section" id="content-get-characters">
                <h2>add new loan</h2>
                <p>
                    To add new loan you need to make a POST call to following URL with form data : <strong>This request
                        Content-Type should be multipart/form-data</strong><br>
                    <span class="method-post">POST</span>
                    <code class="higlighted break-word">{{ route('api.v1.loans.add') }}</code>
                </p>
                <br>
                <h4>FORM DATA</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>customer_name</td>
                            <td>String</td>
                            <td>(required) Customer name.</td>
                        </tr>
                        <tr>
                            <td>duration</td>
                            <td>Integer</td>
                            <td>(required) The duration of the loan.</td>
                        </tr>
                        <tr>
                            <td>amount</td>
                            <td>Double</td>
                            <td>
                                (required) The amount of the loan.
                            </td>
                        </tr>
                        <tr>
                            <td>bankFile</td>
                            <td>File</td>
                            <td>
                                (required) This file should be .txt, .csv or .pdf in format.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End add new loan -->

            <!-- Get Loan -->
            <div class="overflow-hidden content-section" id="content-get-characters">
                <h2>get loan data</h2>
                <p>
                    To get data of particular loan, you need to make a POST call to the following url with the id of
                    the loan :<br>
                    <span class="method-post">POST</span>
                    <code class="higlighted break-word">{{ env('APP_URL') }}api/v1/loan/get/{LoanID}</code>
                </p>
            </div>
            <!-- End Get Loan -->

            <!-- Customers -->
            <div class="overflow-hidden content-section" id="content-get-characters">
                <h2>get customers</h2>
                <p>
                    To get customer data you need to make a POST call to the following url :<br>
                    <span class="method-post">POST</span>
                    <code class="higlighted break-word">{{ route('api.v1.customer.index') }}</code>
                </p>
            </div>
            <!-- End Customers -->

            <!-- Add New Customer -->
            <div class="overflow-hidden content-section" id="content-get-characters">
                <h2>add new customer</h2>
                <p>
                    To add new customer you need to make a POST call to following URL with form data :<br>
                    <span class="method-post">POST</span>
                    <code class="higlighted break-word">{{ route('api.v1.customer.add') }}</code>
                </p>
                <br>
                <h4>FORM DATA</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>customer_name</td>
                            <td>String</td>
                            <td>(required) Customer name.</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>String</td>
                            <td>(optional) The email of the customer.</td>
                        </tr>
                        <tr>
                            <td>phone_number</td>
                            <td>String</td>
                            <td>
                                (option) The phone number of the customer.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End add new customer -->

            <!-- Get Customer -->
            <div class="overflow-hidden content-section" id="content-get-characters">
                <h2>get customer data</h2>
                <p>
                    To get data of particular customer with loan data, you need to make a POST call to the following url
                    with the id of the loan :<br>
                    <span class="method-post">POST</span>
                    <code class="higlighted break-word">{{ env('APP_URL') }}api/v1/customer/get/{CustomerID}</code>
                </p>
            </div>
            <!-- End Get Customer -->



            <div class="overflow-hidden content-section" id="content-errors">
                <h2>Errors</h2>
                <p>
                    The API uses the following error codes:
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Error Code</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>X000</td>
                            <td>
                                Some parameters are missing. This error appears when you don't pass every mandatory
                                parameters.
                            </td>
                        </tr>
                        <tr>
                            <td>X001</td>
                            <td>
                                Unknown or unvalid <code class="higlighted">api_key</code>. This error appears if you
                                use an unknow API key or if your API key expired.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        .github-corner:hover .octo-arm {
            animation: octocat-wave 560ms ease-in-out
        }

        @keyframes octocat-wave {

            0%,
            100% {
                transform: rotate(0)
            }

            20%,
            60% {
                transform: rotate(-25deg)
            }

            40%,
            80% {
                transform: rotate(10deg)
            }
        }

        @media (max-width:500px) {
            .github-corner:hover .octo-arm {
                animation: none
            }

            .github-corner .octo-arm {
                animation: octocat-wave 560ms ease-in-out
            }
        }

        @media only screen and (max-width:680px) {
            .github-corner>svg {
                right: auto !important;
                left: 0 !important;
                transform: rotate(270deg) !important;
            }
        }
    </style>
    <!-- END Github Corner Ribbon - to remove -->
    <script src="{{ asset('documentation/js/script.js') }}"></script>
</body>

</html>
