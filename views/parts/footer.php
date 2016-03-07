</div>
<div id="footer">
    <p id='copy'>&copy; Shop 2016<p>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.to_cart').click(function(){
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function(data){
                $('.cart_count').html(data);
            });
            return false;
        });
    });

</script>
</body>
</html>
