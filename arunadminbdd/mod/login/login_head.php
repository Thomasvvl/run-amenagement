<title> <?php echo $TITLE; ?> - Login </title>
<link rel="stylesheet" type="text/css" href="css/formulaire.css" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<style type="text/css">
    body {
        background-image: linear-gradient(to right top, #f36d33, #c95239, #9b3c38, #6c2b30, #3f1c22, #3f1c22, #3f1c22, #3f1c22, #6c2b30, #9b3c38, #c95239, #f36d33);

    }

    form {
        /* background-color: transparent ; */
        position: absolute;
        background-color: hsla(5, 50%, 30%, 0.1);
        width: 400px;
        height: 400px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }

    .sign {
        padding-top: 40px;
        color: #ffffff;
        font-family: "Ubuntu", sans-serif;
        font-weight: bold;
        font-size: 23px;
    }

    #login {
        width: 76%;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 1px;
        background: rgba(136, 126, 126, 0.10);
        padding: 10px 20px;
        border: none;
        border-radius: 20px;
        outline: none;
        box-sizing: border-box;
        border: 2px solid rgba(0, 0, 0, 0.10);
        margin-bottom: 50px;
        margin-left: 46px;
        text-align: center;
        margin-bottom: 27px;
        font-family: "Ubuntu", sans-serif;
    }

    ::placeholder {
        color: #fff;
        opacity: 0.5;
    }

    .form1 {
        padding-top: 40px;
    }

    #password {
        width: 76%;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 1px;
        background: rgba(136, 126, 126, 0.10);
        padding: 10px 20px;
        border: none;
        border-radius: 20px;
        outline: none;
        box-sizing: border-box;
        border: 2px solid rgba(0, 0, 0, 0.10);
        margin-bottom: 50px;
        margin-left: 46px;
        text-align: center;
        margin-bottom: 27px;
        font-family: "Ubuntu", sans-serif;
    }

    .un:focus,
    .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;
    }

    .submit {
        cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #fa7d49, #f26b31);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: "Ubuntu", sans-serif;
        margin-left: 30%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    }

    .forgot {
        font-family: "Ubuntu", sans-serif;
        font-size: 12px;
        padding-top: 15px;
    }

    a {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #fff;
        text-decoration: none;
    }

    .login_ok {
        width: 70%;
        margin: auto;
        height: 48.5px;
        line-height: 47px;
        background-color: rgba(0, 255, 0, 0.4);
        border-bottom-left-radius: 24px;
        border-bottom-right-radius: 24px;
        color: black;
        border-radius: 5px;
        text-align: center;


    }

    .login_ko {
        width: 100%;
        margin: auto;
        height: 48.5px;
        line-height: 47px;
        background-color: rgba(255, 0, 0, 0.4);
        border: none;
        border-bottom-left-radius: 24px;
        border-bottom-right-radius: 24px;
        color: white;
        font-size: 20px;
        text-align: center;

    }
</style>