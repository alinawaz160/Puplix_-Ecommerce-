<?php require("top.php");
?>

<div class="container py-5">
    <div class="row gx-5">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <h1><i>Get in Touch:</i></h1>
            <form>
                <div class="mb-3">

                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name"
                        required>
                </div>
                <div class="mb-3">

                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"
                        required>
                </div>
                <div class="mb-3">

                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label" aria-placeholder="Optional">Message</label>
                    <textarea class="form-control" id="message" name="message" placeholder="Express Your Feelings !!"
                        rows="4" required></textarea>
                </div>


                <button  class="btn" onclick="send_message()"
                    style="background-color: blueviolet;">Send Message</button>

            </form>
        </div>
        <div class="col-lg-6">
            <br>
            <img src="contact.jpg" alt="Contact Image" class="img-fluid"><br>

        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function send_message() {
        var name = jQuery("#name").val();
        var email = jQuery("#email").val();
        var phone = jQuery("#phone").val();
        var message = jQuery("#message").val();
        var error = '';
        if (name == '') {
            alert("Please enter name");
        }
        else if (email == '') {
            alert("Please enter email");
        }
        else if (phone == '') {
            alert("Please enter phone");
        }
        else if (message == '') {
            alert("Please enter message");
        } else {
            jQuery.ajax({
                url : "contact_us.php",
                type : "post",
                data : "name=" + name + "&email=" + email + "&phone=" + phone + "&message=" + message,
                success: function(result){
                    alert(result);
                }
            });
        }
    }
</script>
<?php require("footer.php") ?>