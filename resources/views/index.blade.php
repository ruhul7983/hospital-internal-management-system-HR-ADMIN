<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip • Hospital Internal Management System</title>
    <link rel="stylesheet" href="style.css">

    <!-- Recommended: Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Optional Dynamic Greeting -->
    <div id="greeting-banner" class="greeting-banner"></div>

    <main class="card">
        <header class="header">
            <h1 class="title">Hospital Internal Management System</h1>
            <p class="subtitle">Payslip for April 2024</p>
        </header>

        <section class="employee-info">
            <h2 class="section-title">Employee Information</h2>

            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Name:</span>
                    <span class="value">John Doe</span>
                </div>

                <div class="info-item">
                    <span class="label">Designation:</span>
                    <span class="value">Nurse</span>
                </div>
            </div>
        </section>

        <section class="salary-section">
            <h2 class="section-title">Salary Breakdown</h2>

            <div class="table-wrapper">
                <table class="salary-table">
                    <thead>
                        <tr>
                            <th>Earnings</th>
                            <th>Deductions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p class="line"><span>Base Salary</span> <strong>$3,000</strong></p>
                                <p class="line"><span>Overtime</span> <strong>$400</strong></p>
                            </td>

                            <td>
                                <p class="line"><span>Total Deductions</span> <strong>$200</strong></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="net-salary">
            <p class="net-text">Net Salary</p>
            <p class="net-amount">$3,200</p>
        </section>
    </main>

    <script src="script.js"></script>
    <script>
        if (typeof displayGreeting === "function") {
            displayGreeting("greeting-banner");
        }
    </script>

</body>
</html>
