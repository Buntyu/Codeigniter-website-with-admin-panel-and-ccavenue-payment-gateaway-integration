<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jquery Raty usage in PHP - Simple Star Ratting Plugin</title>
</head>
<body>
<div>
    <!-- We use three products below and make DIVs with class star for showing stars -->
    <h3>Mobile</h3>
    <p>it a first product (444444)</p>
    <div id="444444" class="<?= $post_id ?>"></div>

    <h3>Laptop</h3>
    <p>it a second product (666666)</p>
    <div id="666666" class="star"></div>

    <h3>Magazine</h3>
    <p>it a third product (777777)</p>
    <div id="777777" class="star"></div>

</div>
<!-- Jquery and Raty Js with scrpt having class star
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?= base_url() ?>global/site/rating/js/jquery.min.js"></script>
<!--For Raty-->
<script type="text/javascript" src="<?= base_url() ?>global/site/rating/js/jquery.raty.min.js"></script>

<script type="text/javascript">

    $(function() {
        <!-- Below line will get stars images from img folder -->
        $.fn.raty.defaults.path = '<?= base_url() ?>global/site/rating/img';
        <!-- Below block code will post score and pid to raty1.php page where you will insert/update it into database. you can also change raty settings also from here. please read documentations -->
        $(".<?= $post_id ?>").raty({
            <?php if(isset($rates) and $rates != 0){ ?>
            start:     <?= $rates ?>,
              <?php  } ?>
            <?php if($is_rated == true){ ?>
             readOnly:   true,
              <?php  } ?>
            half  : true,
            number: 5,
            score : 0,
            click: function(score, evt) {

                var pid=$(this).prop('id');
                $.post('<?= base_url()?>rating/create_rate',{score:score, pid:pid},
                    function(data){
                        alert(score);
                        return $.fn.raty.readOnly(true, '.<?= $post_id ?>');
                    });

            }

        });

    });
</script>
</body>
</html>