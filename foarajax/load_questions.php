<?php
session_start();
include "../connection.php";

$question_no="";
$question="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$answer="";
$count=0;
$ans="";

$queno=$_GET["questionno"];

if(isset($_SESSION["answer"] [$queno]))
{
    $ans=$_SESSION["answer"] [$queno];
}

$res=mysqli_query($link, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' && question_no=$_GET[questionno]");
$count=mysqli_num_rows($res);

if($count==0)
{
    echo "over";
} else
{
    while($row=mysqli_fetch_array($res))
    {
        $question_no=$row["question_no"];
        $question=$row["question"];
        $opt1=$row["opt1"];
        $opt2=$row["opt2"];
        $opt3=$row["opt3"];
        $opt4=$row["opt4"];
    }
    ?>

<div style="padding: 20px; border: 1px solid #444; border-radius: 10px; margin-bottom: 25px; background-color: #222; color: #eee;">
    <table width="100%">
        <tr>
            <td style="font-weight: bold; font-size: 20px; padding-left: 15px; color: #ddd;">
                <?php echo "(".$question_no.") ".$question; ?>
            </td>
        </tr>
    </table>

    <table style="margin-top: 20px; width: 100%;">
        <tr>
            <td style="width: 50%; padding: 10px;">
                <label for="r1_<?php echo $question_no; ?>_1" style="display: block; cursor: pointer; background-color: #333; border: 1px solid #444; border-radius: 8px; padding: 15px; color: #bbb; font-size: 1.1em; transition: background-color 0.2s ease;">
                    <input type="radio" name="r1" id="r1_<?php echo $question_no; ?>_1" value="<?php echo $opt1; ?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                    <?php if($ans==$opt1) { echo "checked"; } ?> style="margin-right: 10px; vertical-align: middle;">
                    <?php
                        if(strpos($opt1, 'images/')!=false)
                        { ?> <img src="admin/<?php echo $opt1; ?>" height="50" width="50" style="vertical-align: middle;"> <?php }
                        else { echo $opt1; }
                    ?>
                </label>
            </td>
            <td style="width: 50%; padding: 10px;">
                <label for="r1_<?php echo $question_no; ?>_2" style="display: block; cursor: pointer; background-color: #333; border: 1px solid #444; border-radius: 8px; padding: 15px; color: #bbb; font-size: 1.1em; transition: background-color 0.2s ease;">
                    <input type="radio" name="r1" id="r1_<?php echo $question_no; ?>_2" value="<?php echo $opt2; ?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                    <?php if($ans==$opt2) { echo "checked"; } ?> style="margin-right: 10px; vertical-align: middle;">
                    <?php
                        if(strpos($opt2, 'images/')!=false)
                        { ?> <img src="admin/<?php echo $opt2; ?>" height="50" width="50" style="vertical-align: middle;"> <?php }
                        else { echo $opt2; }
                    ?>
                </label>
            </td>
        </tr>
        <tr>
            <td style="width: 50%; padding: 10px;">
                <label for="r1_<?php echo $question_no; ?>_3" style="display: block; cursor: pointer; background-color: #333; border: 1px solid #444; border-radius: 8px; padding: 15px; color: #bbb; font-size: 1.1em; transition: background-color 0.2s ease;">
                    <input type="radio" name="r1" id="r1_<?php echo $question_no; ?>_3" value="<?php echo $opt3; ?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                    <?php if($ans==$opt3) { echo "checked"; } ?> style="margin-right: 10px; vertical-align: middle;">
                    <?php
                        if(strpos($opt3, 'images/')!=false)
                        { ?> <img src="admin/<?php echo $opt3; ?>" height="50" width="50" style="vertical-align: middle;"> <?php }
                        else { echo $opt3; }
                    ?>
                </label>
            </td>
            <td style="width: 50%; padding: 10px;">
                <label for="r1_<?php echo $question_no; ?>_4" style="display: block; cursor: pointer; background-color: #333; border: 1px solid #444; border-radius: 8px; padding: 15px; color: #bbb; font-size: 1.1em; transition: background-color 0.2s ease;">
                    <input type="radio" name="r1" id="r1_<?php echo $question_no; ?>_4" value="<?php echo $opt4; ?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                    <?php if($ans==$opt4) { echo "checked"; } ?> style="margin-right: 10px; vertical-align: middle;">
                    <?php
                        if(strpos($opt4, 'images/')!=false)
                        { ?> <img src="admin/<?php echo $opt4; ?>" height="50" width="50" style="vertical-align: middle;"> <?php }
                        else { echo $opt4; }
                    ?>
                </label>
            </td>
        </tr>
    </table>
</div>
<?php
}
?>