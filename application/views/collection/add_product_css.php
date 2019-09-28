<style rel="stylesheet" type="text/css">


    .product-category {
        color: white;
        background-color: #34CAA7;
    }

    .box-heading {
        display: block;
        text-align: center;
        padding: 10px 0 10px 0;
        color: white;
        background-color: #35C9A8;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        outline: none;

    }

    .attribute-list {
        padding: 5px 0 5px 10px;
    }

    .box-off-white {
        background-color: #E1E3E5;
        padding: 0;
        margin: 5px;
    }

    .box-body {
        padding: 15px 10px 10px 10px;
    }

    div {
        padding: 0;
    }

    a.box-heading {
        color: white;
        text-decoration: none;
    }

    a.box-heading:hover {
        color: white;
        text-decoration: none;
    }

    .attribute-item {
        border-bottom: 1px solid #B7B9BB;
        padding-top: 7px;
    }

    .attribute-list {
        padding: 0 5% 0 5%;
    }



    .attribute-details {
        margin-left: 5em;
    !important;
        padding: 15px;
    }

    .attribute-variable {
        display: flex;
    }

    .attribute-variable > span {
        margin: 5px 10px 0 0;
    }
    .background-off-white{
        background-color: #E1E3E5;
        padding: 10px;
        margin-top: 10px;
    }

    input[type='radio']{
        width: 25px;
        border: 4px solid #35C9A7;
        color: white;
    }

    .btn-md-circle{
        height: 35px;
        width: 35px;
        border-radius: 20px;
    }

    .btn-social{
        background: transparent;
        border: 1px solid #515151;
        color: #515151;
    }
    .btn-social.btn-active{
        background-color: #34CAA7;
        border: none;
        color: white;
    }
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #34CAA7;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #34CAA7;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .select_p_display_time,.custom_p_display_time,.fixed_price,.custom_price,.offer-div,.select_reduce_price,.custom_reduce_price{
        display: none;
    }
    @media screen and (max-width: 720px) {
        .attribute-details {
            margin-left: 0;
        }
    }
</style>