<page class="pdf7 buyerpdf7">
    <h1 class="main_title top_title">Nearby Schools</h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <div class="d-flex">
        <div class="col-12">
            <h4 class="mt-0 sub_title">A Little Insight</h4>
        </div>
    </div>
    <div class="d-flex">    
        <div class="col-12">
            <h4 class="table_title">Elementary</h4>
            <table>
                <tr>
                    <td>School Name: <?php echo $school['elementary']['name']; ?></td>
                    <td>Distance: <?php echo $school['elementary']['distance']; ?></td>
                </tr>
                <tr>
                    <td>Address: <?php echo $school['elementary']['address']; ?></td>
                    <td>City: <?php echo $school['elementary']['city']; ?></td>
                </tr>
                <tr>
                    <td>Lowest Grade: <?php echo $school['elementary']['lowest_grade']; ?></td>
                    <td>Highest Grade: <?php echo $school['elementary']['highest_grade']; ?></td>
                </tr>
                <tr>
                    <td>Student/Teacher Ratio: <?php echo $school['elementary']['student_teacher_ratio']; ?></td>
                    <td>Total Enrolled: <?php echo $school['elementary']['total_enrolled']; ?></td>
                </tr>
            </table> 
            <h4 class="table_title">Junior Highschool</h4>
            <table>
                <tr>
                    <td>School Name: <?php echo $school['middle']['name']; ?></td>
                    <td>Distance: <?php echo $school['middle']['distance']; ?></td>
                </tr>
                <tr>
                    <td>Address: <?php echo $school['middle']['address']; ?></td>
                    <td>City: <?php echo $school['middle']['city']; ?></td>
                </tr>
                <tr>
                    <td>Lowest Grade: <?php echo $school['middle']['lowest_grade']; ?></td>
                    <td>Highest Grade: <?php echo $school['middle']['highest_grade']; ?></td>
                </tr>
                <tr>
                    <td>Student/Teacher Ratio: <?php echo $school['middle']['student_teacher_ratio']; ?></td>
                    <td>Total Enrolled: <?php echo $school['middle']['total_enrolled']; ?></td>
                </tr>
            </table>
            <h4 class="table_title">High School</h4>
            <table>
                <tr>
                    <td>School Name: <?php echo $school['high']['name']; ?></td>
                    <td>Distance: <?php echo $school['high']['distance']; ?></td>
                </tr>
                <tr>
                    <td>Address: <?php echo $school['high']['address']; ?></td>
                    <td>City: <?php echo $school['high']['city']; ?></td>
                </tr>
                <tr>
                    <td>Lowest Grade: <?php echo $school['high']['lowest_grade']; ?></td>
                    <td>Highest Grade: <?php echo $school['high']['highest_grade']; ?></td>
                </tr>
                <tr>
                    <td>Student/Teacher Ratio: <?php echo $school['high']['student_teacher_ratio']; ?></td>
                    <td>Total Enrolled: <?php echo $school['high']['total_enrolled']; ?></td>
                </tr>
            </table>
            <h4 class="table_title">Private School</h4>
            <table>
                <tr>
                    <td>School Name: <?php echo $school['private']['name']; ?></td>
                    <td>Distance: <?php echo $school['private']['distance']; ?></td>
                </tr>
                <tr>
                    <td>Address: <?php echo $school['private']['address']; ?></td>
                    <td>City: <?php echo $school['private']['city']; ?></td>
                </tr>
                <tr>
                    <td>Lowest Grade: <?php echo $school['private']['lowest_grade']; ?></td>
                    <td>Highest Grade: <?php echo $school['private']['highest_grade']; ?></td>
                </tr>
                <tr>
                    <td>Student/Teacher Ratio: <?php echo $school['private']['student_teacher_ratio']; ?></td>
                    <td>Total Enrolled: <?php echo $school['private']['total_enrolled']; ?></td>
                </tr>
                <tr>
                    <td>Phone Number: <?php echo $school['private']['phone']; ?></td>
                    <td>Gender: <?php echo $school['private']['gender']; ?></td>
                </tr>
                <tr>
                    <td>Affiliation: <?php echo $school['private']['affiliation']; ?></td>
                    <td>Preschool: <?php echo $school['private']['preschool']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</page>
