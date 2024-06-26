<!DOCTYPE html>
<html lang="en">

<div id="algn">
    <div id="container">
        <p class="head">Login</p>
        <form action="/login" class="input-container" method="POST">
            <label style="color: red"><?php echo $errors['email'] ?? ''; ?></label>
            <input type="email" name="email" placeholder="Enter email" class="inpt" required>
            <label style="color: red"><?php echo $errors['password'] ?? ''; ?></label>
            <input type="password" name="password" placeholder="Enter password" class="inpt" required>
<!--            <div class="rem-forgot">-->
<!--                <div class="rem">-->
<!--                    <input type="checkbox" for="rem-tik">-->
<!--                    <label for="rem-tik">Remember me</label>-->
<!--                </div>-->
<!--                <span><a href="#">Forgot password</a></span>-->
<!--            </div>-->
            <button value="submit" class="btn">Login</button>
        </form>
        <p class="footer">Don't have account? <a href="http://localhost/registration">Register</a></p>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
        background-color: rgb(123, 188, 214);
        background-image: url(https://farm5.staticflickr.com/4249/35281380986_5cef9305f8_o.jpg);
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        margin: 0;
        padding: 0;
        color: white;
    }

    #algn{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #container{
        border: 2px solid white;
        border-radius: 10px;
        width: 320px;
        height: 340px;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
        backdrop-filter: blur(5px);
    }

    #container .head{
        font-weight: 700;
        font-size: larger;
    }

    .input-container{
        display: flex;
        flex-direction: column;
        width: 265px;
    }

    .input-container .inpt{
        padding: 10px;
        margin: 5px 10px;
        border: 2px solid white;
        border-radius: 25px;
        background-color: transparent;
        color: white;
    }

    ::placeholder {
        font-weight: 600;
        color: white;
        opacity: 1;
    }

    .rem-forgot{
        display: flex;
        justify-content: space-around;
        column-gap: 10px;
        font-size: 11px;
        font-weight: 400;
        margin: 8px;
    }

    .rem{
        display: flex;
        align-items: center;
    }

    .rem-forgot span a{
        text-decoration: none;
        color: white;
    }

    .rem-forgot span a:hover{
        color: #ffc3d2;
    }

    .input-container .btn{
        margin: 20px 12px;
        padding: 15px 0;
        border: none;
        border-radius: 25px;
        font-weight: 700;
    }

    .input-container .btn:hover{
        background-color: #ffc3d2;
    }

    #container .footer{
        font-size: 11px;
        font-weight: 400;
    }

    #container .footer a{
        text-decoration: none;
        color: white;
        font-weight: 700;
        margin: 0 5px;
    }

    #container .footer a:hover{
        color: #ffc3d2;
    }
</style>
