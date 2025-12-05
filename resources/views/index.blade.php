<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip • Hospital Internal Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Optional Dynamic Greeting -->
    <div id="greeting-banner" class="greeting-banner"></div>

    <div class="card">
        <header class="header">
            <h1>Hospital Internal Management System</h1>
            <p class="subtitle">Payslip for April 2024</p>
        </header>

        <section class="employee-section">
            <div class="employee-row">
                <span class="label">Name</span>
                <span class="value">John Doe</span>
            </div>
            <div class="employee-row">
                <span class="label">Designation</span>
                <span class="value">Nurse</span>
            </div>
        </section>

        <section class="table-section">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Earnings</th>
                            <th>Deductions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="line"><span>Base Salary:</span> <strong>$3,000</strong></div>
                                <div class="line"><span>Overtime:</span> <strong>$400</strong></div>
                            </td>
                            <td>
                                <div class="line"><span>Deductions:</span> <strong>$200</strong></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="net-section">
            <span>Net Salary:</span>
            <strong class="net-amount">$3,200</strong>
        </section>
    </div>

    <script src="script.js"></script>

    <script>
        if (typeof displayGreeting === "function") {
            displayGreeting("greeting-banner");
        }
    </script>
</body>
</html>
