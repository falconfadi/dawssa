<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte_rtl.css')}}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/rtl.css')}}">

    <title>{{ $title }}</title>
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        .header {
            text-align: right;
            font-weight: bold;
        }
        .divider {
            border-top: 1px solid black;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .customer-info {
            margin-top: 20px;
            font-weight: bold;
            direction: rtl;
        }

    </style>
</head>

<body>
<div class="header">
    <p>الجمهورية العربية السورية</p>
    <p>مؤسسة مياه دمشق </p>
    <p>رقم الإيصال {{ $receiptNumber }}</p>
    <div class="divider"></div>
</div>

<div class="customer-info">
    <p>اسم العميل: {{ $customerName }}</p>
    <p>رقم الهاتف: {{ $phoneNumber }}</p>
    <p>نوع العقار: {{ $propertyType }}</p>
</div>

</body>
</html>
