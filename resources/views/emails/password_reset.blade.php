@component('mail::message')
# Chào **{{ $user->name }}**,

Đây là mật khẩu mới của bạn: **{{ $newPassword }}**

Vui lòng đăng nhập và thay đổi mật khẩu của bạn ngay để tối ưu nhất.

Trân trọng, <br>
Nhân viên FootForward!
@endcomponent
