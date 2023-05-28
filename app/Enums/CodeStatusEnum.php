<?php

namespace App\Enums;

enum CodeStatusEnum:string {
    case SUCCESS = 'success';
    case ERROR = 'error';
}
enum GetMessage:string {
    case ADD_SUCCESS = 'Thêm thành công';
    case ADD_ERROR = 'Thêm thất bại';
    case EDIT_SUCCESS = 'Sửa thành công';
    case EDIT_ERROR = 'Sửa thất bại';
    case DELETE_SUCCESS = 'Xóa thành công';
    case DELETE_ERROR = 'Xóa thất bại';
}
