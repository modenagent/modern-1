<style>
    .page5_pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 100px;
    }
    .page5-pdf-body{
        position: absolute;
        top: 100px;
        left: 0;
        right: 0;
    }
    .text-right{
        text-align: right;
    }
    .page-title {
        font-family: 'BebasNeue Book';
        font-size: 80px;
        line-height: 70px;
        color: #152270;
        text-align: center;
    }
    .page-title span{
        font-family: "Bebas Neue", sans-serif;
        color: #d79547;
    }
    .page5_pdf_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .page5-table{
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        font-size: unset;
    }
    .page5-table tbody td{
        padding: 6px 20px;
        background:#f0f1f7;
        border-top: 2px solid #e6e8f7;
    }
    .page5-table thead th{
        background-color: #152170;
        font-weight: bold;
        font-size: 18px;
        color: #fff;
        padding: 15px 20px;
        text-align: left;
    }
    .page5-table tfoot td{
        background-color: #d79547;
        font-weight: bold;
        font-size: 18px;
        color: #000;
        padding: 10px 20px;
    }
</style>

<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="page5_pdf_header">
            <div class="page-title">AREA SALES <span>ANALYSIS</span></div>
        </div>
        <div class="page5-pdf-body">
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/sales-analysis.png"); ?>" class="img-fluid" alt="">
            <table class="page5-table">
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
                        <td>1</td>
                        <td>7</td>
                        <td>750</td>
                    </tr>
                    <tr>
                        <td>Price Per Soft</td>
                        <td>$469</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Year Built</td>
                        <td>1949</td>
                        <td>1954</td>
                        <td>1970</td>
                        <td>1984</td>
                    </tr>
                    <tr>
                        <td>Lot Size</td>
                        <td>6,155</td>
                        <td>750</td>
                        <td>5,559</td>
                        <td>10,104</td>
                    </tr>
                    <tr>
                        <td>Bedrooms</td>
                        <td>2</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>Baths</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>2</td>
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
                        <td>$17,000</td>
                        <td>$3,000</td>
                        <td>$700,000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
