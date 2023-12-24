
    <?php require_once "includes/dashboard-header.php"; ?>
    <?php require_once "includes/business-nav.php"; ?>
    <style>
    .statistics {
        display: flex;
        justify-content: center; /* Center the content horizontally */
    }

    .stat-box {
        /* Add a linear gradient background with blue stripes */
        background: repeating-linear-gradient(45deg, rgba(0, 123, 255, 0.2), rgba(0, 123, 255, 0.2) 10px, rgba(0, 123, 255, 0.1) 10px, rgba(0, 123, 255, 0.1) 20px);
        padding: 20px;
        border-radius: 10px;
        margin: 10px;
        width: 100%; /* Set width to 100% */
        text-align: center;
    }
</style>
    <body>
    <div class="container">

        <!-- Welcome Message -->
        <div class="welcome-message">
            <h3>Welcome, <span style="color: blue;"><?= $_SESSION['lastname']; ?></span></h3>
        </div>

        <!-- Business Summary -->
        <div class="business-summary">
            <h2>Business Summary</h2>
            <p>You are welcome to the Smart Campus Business Dashboard where you can monitor all the activities going on in the system.</p>
        </div>

        <!-- Statistics -->
        <div class="statistics">
            <div class="stat-box">
                <h5>Total Earnings</h5>
                <p>$5000</p> <!-- Fetch dynamically from the database -->
            </div>
            <div class="stat-box">
                <h5>Total Users</h5>
                <p>1000</p> <!-- Fetch dynamically from the database -->
            </div>
        </div>

        <!-- Sales Graph -->
        <div class="sales-graph">
            <h2>Sales Graph</h2>
            <canvas id="salesChart"></canvas>
        </div>

    </div>

    <?php require_once "includes/dashboard-footer.php"; ?>

    <script src="assets/vendor/chart.js"></script>

</body>

</html>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
const data = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
        label: 'Sales',
        data: [200, 300, 400, 500, 600, 700], // Sample data; replace with your actual sales data
        backgroundColor: 'rgba(0, 123, 255, 0.5)',
        borderColor: 'rgba(0, 123, 255, 1)',
        borderWidth: 1
    }]
};
const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};
const salesChart = new Chart(ctx, config);

</script>