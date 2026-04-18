<div id="wrapper">
    <div id="content">
        <div id="box">
            <?php if (session::get('user_company_code')) { ?>
                <div id="error"> 
                    <?php $this->renderFeedbackMessages(); ?>
                </div>
                <div style="display: none;"id="totVal">
                    <div class="totDiv" id="totA">
                        <span class="totTitle">Confirmed Booking</span>
                        <span class="totValNum" id="totAval"></span>
                    </div>
                    <div class="totDiv" id="totF">
                        <span class="totTitle">Payment failed</span>
                        <span class="totValNum" id="totFval"></span>
                    </div>
                    <div class="totDiv" id="totC">
                        <span class="totTitle">Canceled</span>
                        <span class="totValNum" id="totCval"></span>
                    </div>
                </div>
                <div style="width:50%;"class="chMain" id="chartReport"></div>
                <div class="chMain" id="chartReportPie"></div>
                <form id="form">
                    <input placeholder="Start Date" id="startDate" type="hidden" name="startDate" value="<?php echo date('Y-m-d') ?>"/>
                    <input placeholder="End Date" id="endDate" type="hidden" name="endDate" value="<?php echo date('Y-m-d') ?>"/>
                </form>
                <script>
                    genarateChartReport();
                </script>
            <?php } else { ?>
                <div id="errorMsg"> 
                    <p style="color: green;font-size: 14px;">Welcome to simulator admin portal.Please click one of above menu item to go ahead...</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

