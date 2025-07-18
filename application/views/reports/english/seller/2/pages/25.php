<style>
    .pdf-body {
      font-family: Arial, sans-serif;
      white-space: pre-wrap; /* preserves \n line breaks */
      padding: 30px;
      font-size: 15px;
      color: #333;
      background: #fff;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table, th, td {
      border: 1px solid #bbb;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f0f0f0;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="page8_pdf_header">
            <div class="page8-page-title">Summary Report</div>
        </div>
        <div class="pdf-body page8-body-margin">
            <?php  echo $ai_summary; ?>
        </div>
    </div>
</div>
