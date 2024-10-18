<style>
    .pdf5_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 120px;
    }
    .pdf5-body{
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
    }
    .text-right{
        text-align: right;
    }
    .page5-title {
        font-size: 40px;
        font-weight: 700;
        color: #3fbfb0;
        background: url(<?php echo base_url("assets/reports/english/seller/4/img/title-decoration.png"); ?>) no-repeat;
        background-size: 350px;
        background-position: center right;
        line-height: 50px
    }
    .pdf5_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .table{
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
    }
    .table tbody td{
        padding: 6px 20px;
        background:#f0f1f7;
        border-top: 2px solid #e6e8f7;
    }
    .table thead th{
        background-color: #152170;
        font-weight: bold;
        font-size: 18px;
        color: #fff;
        padding: 15px 20px;
        text-align: left;
    }
    .table tfoot td{
        background-color: #3fbfb0;
        font-weight: bold;
        font-size: 18px;
        color: #000;
        padding: 10px 20px;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf5_header">
            <div class="page5-title">AREA SALES ANALYSIS</div>
            <p>SALES IN THE PAST 12 MONTHS</p>
        </div>
        <div class="pdf5-body">
            <img src="<?php echo base_url("assets/reports/english/seller/4/img/sales-analysis.png"); ?>" class="img-fluid" alt="">
            <table class="table">
                <thead>
                    <tr>
                        <th>Monthly Sales Overview</th>
                        <th>PIQ</th>
                        <th>Low</th>
                        <th>Medium</th>
                        <th>High</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Distance</td>
                        <td>0</td>
                        <td>0.24</td>
                        <td>0.54</td>
                        <td>0.58</td>
                    </tr>
                    <tr>
                        <td>Living Area</td>
                        <td>786</td>
                        <td>698</td>
                        <td>912</td>
                        <td>940</td>
                    </tr>
                    <tr>
                        <td>Price Per Soft</td>
                        <td>$469</td>
                        <td>$610</td>
                        <td>$696</td>
                        <td>$845</td>
                    </tr>
                    <tr>
                        <td>Year Built</td>
                        <td>1949</td>
                        <td>1910</td>
                        <td>1952</td>
                        <td>1953</td>
                    </tr>
                    <tr>
                        <td>Lot Size</td>
                        <td>6,155</td>
                        <td>4,917</td>
                        <td>6,261</td>
                        <td>7,446</td>
                    </tr>
                    <tr>
                        <td>Bedrooms</td>
                        <td>2</td>
                        <td>1</td>
                        <td>3</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>Baths</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Stories</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Pools</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Sales Price</td>
                        <td>$369,000</td>
                        <td>$470,000</td>
                        <td>$610,750</td>
                        <td>$635,000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
