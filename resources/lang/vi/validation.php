<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Thuộc tính :attribute phải được chấp nhận.',
    'active_url'           => 'Thuộc tính :attribute không phải là một URL hợp lệ.',
    'after'                => 'Thuộc tính :attribute phải là ngày sau :date.',
    'after_or_equal'       => 'Thuộc tính :attribute phải là ngày sau hoặc bằng :date.',
    'alpha'                => 'Thuộc tính :attribute chỉ có thể chứa chữ cái.',
    'alpha_dash'           => 'Thuộc tính :attribute chỉ có thể chứa chữ cái, số, và dấu gạch ngang.',
    'alpha_num'            => 'Thuộc tính :attribute chỉ có thể chứa chữ cái và số.',
    'array'                => 'Thuộc tính :attribute phải là 1 mảng.',
    'before'               => 'Thuộc tính :attribute phải là ngày trước hoặc bằng :date.',
    'between'              => [
        'numeric' => 'Thuộc tính :attribute phải nằm trong khoảng :min đến :max.',
        'file'    => 'Kích thước :attribute phải nằm trong khoảng :min đến :max kilobytes.',
        'string'  => 'Thuộc tính :attribute phải nằm trong khoảng :min đến :max chữ cái.',
        'array'   => 'Thuộc tính :attribute phải nằm trong khoảng :min đến :max phần tử.',
    ],
    'boolean'              => 'Thuộc tính :attribute phải là đúng hoặc sai.',
    'confirmed'            => 'Thuộc tính :attribute xác nhận không trùng khớp.',
    'date_format'          => 'Thuộc tính :attribute không khớp với định dạng :format.',
    'different'            => 'Thuộc tính :attribute và :other phải khác nhau.',
    'digits'               => 'Thuộc tính :attribute phải là :digits chữ số.',
    'digits_between'       => 'Thuộc tính :attribute phải nằm giữa :min và :max chữ.',
    'dimensions'           => 'Thuộc tính :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct'             => 'Thuộc tính :attribute giá trị trùng lặp.',
    'email'                => 'Thuộc tính :attribute phải là email hợp lệ.',
    'exists'               => 'Lựa chọn :attribute là không hợp lệ.',
    'file'                 => 'Thuộc tính :attribute phải là 1 tệp tin.',
    'filled'               => 'Thuộc tính :attribute phải có giá trị.',
    'image'                => 'Thuộc tính :attribute phải là ảnh.',
    'in'                   => 'Lựa chọn :attribute không hợp lệ.',
    'in_array'             => 'Thuộc tính :attribute không tồn tại trong :other.',
    'integer'              => 'Thuộc tính :attribute phải là kiểu số nguyên',
    'ip'                   => 'Thuộc tính :attribute phải là IP hợp lệ.',
    'json'                 => 'Thuộc tính :attribute phải là chuỗi JSON.',
    'max'                  => [
        'numeric' => 'Thuộc tính :attribute không thể lớn hơn :max.',
        'file'    => 'Kích thước :attribute không thể lớn hơn :max kilobytes.',
        'string'  => 'Thuộc tính :attribute không  được lớn hơn :max ký tự.',
        'array'   => 'Thuộc tính :attribute không thể nhiều hơn :max phần tử.',
    ],
    'mimes'                => 'Thuộc tính :attribute phải là 1 tệp của: :values.',
    'mimetypes'            => 'Thuộc tính :attribute phải là 1 tệp của: :values.',
    'min'                  => [
        'numeric' => 'Thuộc tính :attribute phải có ít nhất :min số',
        'file'    => 'Thuộc tính :attribute phải có ít nhất :min kilobytes.',
        'string'  => 'Thuộc tính :attribute phải có ít nhất :min ký tự.',
        'array'   => 'Thuộc tính :attribute phải có ít nhất :min phần tử.',
    ],
    'not_in'               => 'Thuộc tính :attribute không hợp lệ.',
    'numeric'              => 'Thuộc tính :attribute phải là số.',
    'present'              => 'Thuộc tính :attribute phải tồn tại.',
    'regex'                => 'Thuộc tính :attribute định dạng không hợp lệ.',
    'required'             => ':attribute không được để trống.',
    'required_if'          => 'Thuộc tính :attribute là bắt buộc khi :other là :value.',
    'required_unless'      => 'Thuộc tính :attribute là bắt buộc trừ khi :other có giá trị :values.',
    'required_with'        => 'Thuộc tính :attribute là bắt buộc khi :values tồn tại.',
    'required_with_all'    => 'Thuộc tính :attribute là bắt buộc khi :values tồn tại.',
    'required_without'     => 'Thuộc tính :attribute là bắt buộc khi :values không tồn tại.',
    'required_without_all' => 'Thuộc tính :attribute bắt buộc khi không tồn tại :values.',
    'same'                 => 'Thuộc tính :attribute và :other phải khớp.',
    'size'                 => [
        'numeric' => 'Thuộc tính :attribute phải là :size.',
        'file'    => 'Thuộc tính :attribute phải có kích thước :size kilobytes.',
        'string'  => 'Thuộc tính :attribute phải chứa :size các ký tự.',
        'array'   => 'Thuộc tính :attribute phải chứa các mục có kích thước :size .',
    ],
    'string'               => 'Thuộc tính:attribute cần phải là chuỗi',
    'timezone'             => 'Múi giờ :attribute không hợp lệ ',
    'unique'               => 'Đã tồn tại :attribute .',
    'uploaded'             => 'Tải lên :attribute không thành công',
    'url'                  => 'Định dạng :attribute không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'Tùy chỉnh thông báo ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'full_name' => 'Tên',
        'username' => 'Tên người dùng',
        'phone' => 'Số điện thoại',
        'password' => 'Mật khẩu',
        'content' => 'Nội dung',
        'hotelSourceArea' => 'Địa điểm',
        'checkin' => 'Ngày nhận phòng'
    ],

];
