<form id="contactform" method="POST" class="validateform" action="">
    @csrf
    <div id="sendmessage">
        Ваше сообщение отправлено!
    </div>
    <div id="senderror">
        При отправке сообщения произошла ошибка. Продублируйте его, пожалуйста, на почту администратора <span>{{ env('MAIL_ADMIN_EMAIL') }}</span>
    </div>
    <div class="row">
        <div class="col-lg-4 field">
            <input type="text" name="name" placeholder="* Введите ваше имя" required />
        </div>
        <div class="col-lg-4 field">
            <input type="email" name="email" placeholder="* Введите ваш email" required />
        </div>
        <div class="col-lg-4 field">
            <input type="text" name="subject" placeholder="* Введите тему сообщения" required />
        </div>
        <div class="col-lg-12 margintop10 field">
            <textarea rows="12" name="message" class="input-block-level" placeholder="* Ваше сообщение..." required></textarea>
            <p>
                <button class="btn btn-theme margintop10 pull-left" type="submit">Отправить</button>
                <span class="pull-right margintop20">* Заполните, пожалуйста, все обязательные поля!</span>
            </p>
        </div>
    </div>
</form>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#contactform').on('submit', function (e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '/sendmail',
                    data: data,
                    dataType: 'json',
                    /*beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },*/
                    success: function (data) {
                        if (data.result) {
                            $('#senderror').hide();
                            $('#sendmessage').show();
                        } else {
                            $('#senderror').show();
                            $('#sendmessage').hide();
                        }
                    },
                    error: function () {
                        $('#senderror').show();
                        $('#sendmessage').hide();
                    }/*,
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }*/
                });
            });
        });
    </script>
@endsection

@section('style')
    <style>
    #sendmessage, #senderror {
        border:1px solid #e6e6e6;
        background:#f6f6f6;
        display:none;
        text-align:center;
        padding:15px 12px 15px 65px;
        margin:10px 0;
        font-weight:600;
        margin-bottom:30px;
    }

    #senderror {
        color: #f00;
    }

    #senderror span {
        font-weight: bold;
    }
    </style>
@endsection
