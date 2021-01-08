<style>

    .site__preview {
        flex-direction: column;
    }

    .text__preview {
        font-family: "{!! $preferences->font_family !!}", sans-serif;
    }

    .logo__container {
        width: 100%;
        background-color: {!! $preferences->primary_color !!};
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }

    .logo__content {
        height: 300px;
        background-color: #FCFCFC;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }

    .logo__footer {
        height: 50px;
        background-color: {!! $preferences->secondary_color !!};
        display: flex;
        justify-content: space-around;
    }

    .logo__img {
        width: auto;
        height: 50px;
    }

    .logo__footer p {
        color: white;
    }


    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-left: 1em;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

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
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
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
    .enable-edit {
        margin-top: 1em;
        display: flex;
        align-items: center;
    }

    .enable-edit span {
        font-size: 20px;
        font-weight: 500; 
    }
</style>