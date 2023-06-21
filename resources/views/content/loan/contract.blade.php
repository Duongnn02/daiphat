<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .card {
            font: normal 13px/1.4em 'charis silb', 'Charis silb';
        }

        .card-header {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
        }

        .contract,
        .date {
            text-align: center;
        }

        li {
            list-style-type: none;
            font-size: 15px;
        }

        td {
            text-align: left;
        }
    </style>
</head>
<style>

</style>

<body>


    <div class="card">
        <div class="loan-index d-flex row">
            <div class="title-loan col-md-3">
                <img src="https://vaydaiphat.com/images/4a93f0dda55c5f6d862429781199348f-logo.png" width="100px">
                <p class="card-header">ĐỀ NGHỊ CẤP TÍN DỤNG KIÊM HỢP ĐỒNG TÍN DỤNG KIÊM THỎA THUẬN SỬ DỤNG DỊCH VỤ ĐIỆN
                    TỬ <br>(“Hợp Đồng”)<br><span><b>Số: {{ $loan->contract_number }} ngày
                            {{ $loan->updated_at }}</b></span></p>
            </div>
            <div class="col-md-12">

                <p> <b> A. PHẦN ĐỀ NGHỊ CẤP TÍN DỤNG VÀ THỎA THUẬN SỬ DỤNG DỊCH VỤ ĐIỆN TỬ</b></p>
                <ol start="1">
                    <b>
                        <li>1. Thông tin Bên vay</li>
                    </b>
                    <table class="table table-bordered">
                        <tr>
                            <td>1.1. Họ tên:<b> {{ $loan->user->name }}</b></td>
                        </tr>
                        <tr>
                            <td>1.2. Ngày sinh: {{$loan->user->day_of_birthday}}<b></b></td>
                            <td> 1.3. Quốc tịch: Việt Nam</td>
                        </tr>
                        <tr>
                            <td>1.4. Số CMND/Thẻ CCCD/Hộ chiếu/Giấy tờ khác:<b> {{ $loan->user->cccd_cmnd }}</b></td>
                        </tr>
                        <tr>
                            <td>1.5. Địa chỉ thường trú:<b> {{ $loan->user->permanent_address }}</b></td>
                        </tr>
                        <tr>
                            <td>1.6. Địa chỉ nơi ở hiện tại:<b> {{ $loan->user->address }}</b></td>
                        </tr>
                        <tr>
                            <td>1.7. Điện thoại di động:<b> {{ $loan->user->phone }}</b></td>
                            <td>1.8. Email:<b> {{ $loan->user->email }}</b></td>
                        </tr>
                        <tr>
                            <td>1.9. Nghề nghiệp:<b> {{ $loan->user->academic_level }}</b></td>
                            <td>1.10. Thu nhập:<b> {{ $loan->user->salary }}</b> VNĐ/tháng</td>
                        </tr>
                    </table>
                    <b>
                        <li>2. Nội dung đề nghị vay vốn</li>
                    </b>
                    <table class="table table-bordered">
                        <tr>
                            <td>2.1. Mục đích sử dụng vốn vay: {{ $loan->user->loan_purpose }}</td>
                        </tr>
                        <tr>
                            <td>2.2. Số tiền đề nghị vay: <b>{{ number_format($loan->total_loan) }}</b> VNĐ</td>
                            <td>2.3. Thời hạn vay: <b> {{ $loan->time }} </b>Tháng</td>
                        </tr>
                        <tr>
                            <td>2.4. Lãi suất theo Dư nợ ban đầu hàng tháng: <b>3,24%</b></td>
                        </tr>

                    </table>
                    <b>
                        <li>3. Nội dung bảo hiểm</li>
                    </b>
                    <div style="display: flex">
                        <table>
                            <tr>
                                <td>Bên Vay hoàn toàn tự nguyện đồng ý mua bảo hiểm</td>
                                <td> Có [x] Không []</td>
                            </tr>
                        </table>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>3.1. Bảo hiểm khoản vay tiêu dùng<br>

                                <span>Vay mua bảo hiểm [] Tự thanh toán [x]</span><br>

                                <span>Thông tin công ty bảo hiểm: Tổng công ty cổ phần Bảo Minh</span><br>

                                <span>Số tiền bảo hiểm: Theo quy tắc bảo hiểm của công ty bảo hiểm và được Công ty Tài
                                    chính trách nhiệm hữu hạn ĐẠI PHÁT công bố tại website <a
                                        href="http://nndbe.site/home"> www.daiphat</a></span><br>

                                <span>Phí bảo hiểm:<b>50,000</b> VNĐ/tháng Tổng phí bảo hiểm: <b>300,000 VNĐ</b></span>
                            </td>
                        </tr>
                    </table>
                    <b>
                        <li>4. Xác nhận và cam kết của Bên Vay</li>
                    </b>
                    <p>Qua tìm hiểu và được Nhân viên của Công ty Tài chính trách nhiệm hữu hạn ĐẠI PHÁT (“<b>Bên Cho
                            Vay<b>”) giải
                                thích các vấn đề liên quan đến chính sách cho vay, bảo hiểm và Dịch vụ điện tử, Bên Vay
                                xác nhận và cam kết:
                    </p>
                    <p>4.1. Tất cả các thông tin, tài liệu Bên Vay cung cấp cho Bên Cho Vay là chính xác, hợp pháp và
                        không có
                        thông tin nào bị che giấu hoặc bị làm sai lệch. Bên Vay đã được Bên Cho Vay cung cấp dự thảo Hợp
                        Đồng và
                        giải thích chính xác, đầy đủ, trung thực các nội dung cơ bản tại Hợp Đồng, bao gồm cả quyền và
                        nghĩa vụ
                        của Bên Vay; các biện pháp đôn đốc, thu hồi nợ; biện pháp xử lý trong trường hợp Bên Vay không
                        thực hiện
                        nghĩa vụ theo Hợp Đồng, để xem xét, quyết định trước khi ký kết Hợp Đồng.
                    </p>
                    <p>4.2. Bên Vay xác nhận:</p>
                    <div style="padding-left: 20px">
                        <p>4.2.1. Đồng ý nhận thông tin quảng cáo về các sản phẩm, dịch vụ mới, chương trình khuyến mại
                            của Bên Cho Vay:</p>
                        <p><span>Có [x] Không [ ]</span><br>4.2.2. Đồng ý cho Bên Cho Vay chuyển nhượng hoặc chuyển giao
                            Khoản Nợ của Bên Vay tại
                            Bên Cho Vay cùngvới tất cả các quyền và nghĩa vụ có liên quan theo Hợp Đồng cho bên thứ ba:
                        </p>
                        <p><span>Có [x] Không [ ]</span><br> 4.2.3. Đồng ý cho Bên Cho Vay tiết lộ thông tin của Bên
                            Vay, thông tin liên quan đến
                            Bên Vay và Khoản Nợ của Bên Vay tại Bên Cho Vay cho bên thứ ba:</p>
                        <p><span>Có [x] Không [ ]</span><br>4.2.4. Trường hợp Bên Vay ký kết Hợp Đồng này không thông
                            qua Dịch vụ điện tử do Bên Cho Vay cung cấp,

                            Bên Vay đồng ý giữ 01 (một) bản chính của Hợp Đồng có chữ ký của Bên Vay, Người chứng kiến
                            (Nhân viên
                            Tín dụng của Bên Cho Vay) (nếu có) và không đóng dấu của Bên Cho Vay (Bên Vay có thể gọi
                            điện qua đường
                            dây nóng CSKH bộ phận hổ trợ để yêu cầu Bên Cho Vay cung cấp bản sao Hợp Đồng có đóng dấu
                            của Bên Cho
                            Vay):

                            Có [x] Không [ ]</p>
                        <p>4.3. Bên Vay đồng ý sử dụng Dịch vụ điện tử do Bên Cho Vay cung cấp theo Điều Khoản Và Điều
                            Kiện Sử Dụng
                            Dịch Vụ Điện Tử (là một phần không tách rời của Hợp Đồng, được niêm yết công khai tại trụ sở
                            chính, chi
                            nhánh, điểm giới thiệu dịch vụ, website <a href="http://nndbe.site/home"> www.daiphat</a> và
                            (các) phương tiện điện tử khác theo quy định của Bên
                            Cho Vay từng thời kỳ).
                        </p>
                    </div>
                </ol>
                <ol>
                    <h3><b>B. PHẦN HỢP ĐỒNG TÍN DỤNG</b></h3>
                    <b>
                        <li>1. Bên Vay</li>
                    </b>
                    <p>Theo các thông tin được nêu chi tiết tại Mục A.1 của Hợp Đồng.</p>
                    <b>
                        <li>2. Bên Cho Vay</li>
                    </b>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Công ty Tài chính trách nhiệm hữu hạn ĐẠI PHÁT</b></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ: Đường 80 T. Trấn Liên Quan,T/Thất</p>
                        </tr>
                        <tr>
                            <td>Mã số doanh nghiệp:</td>
                        </tr>
                        <tr>
                            <td>Điện thoại: (04) 33842219</td>
                        </tr>
                        <tr>
                            <td>Điện thoại của Phòng Dịch vụ khách hàng: CSKH - Số máy lẻ: 2 hoặc 3 hoặc 5</td>
                        </tr>
                        <tr>
                            <td>Bên Vay và Bên Cho Vay, sau đây gọi chung là “<b>các Bên</b>”, thỏa thuận các điều khoản
                                và điều kiện như sau:</td>
                        </tr>
                    </table>
                    <b>
                        <li>3. Thông tin tài khoản của Bên Vay</li>
                    </b>
                    <table>
                        <tr>
                            <td>Tên Chủ Tài khoản: <b>{{ $loan->user->account_name }}</b></td>
                        </tr>
                        <tr>
                            <td>Số tài khoản: Theo Thông tin do Bên Vay cung cấp <b>{{ $loan->user->number_bank }}</b></td>
                        </tr>
                        <tr>
                            <td>Tên Ngân hàng/Bưu cục: Theo Thông tin do Bên Vay cung cấp <b>{{ $loan->user->bank }}</b>
                            </td>
                        </tr>
                    </table>
                    <b>
                        <li>4. Phương thức cho vay: Cho vay từng lần</li>
                    </b>
                    <b>
                        <li>5. Thông tin Khoản Vay, lịch trả nợ</td>
                    </b>
                    <table class="table table-bordered">
                        <tr>
                            <td>5.1. Khoản Cấp Vốn: {{ number_format($loan->total_loan) }} VNĐ </td>
                        </tr>
                        <tr>
                            <td>5.2. Thời Hạn Vay (tháng): {{ $loan->time }} </td>
                        </tr>
                        <tr>
                            <td>5.3. Lãi Suất Thực Tế Hàng Tháng: 5.33%</td>
                        </tr>
                        <tr>
                            <td>5.4. Khoản Thanh Toán Hàng Tháng: {{ number_format($loan->recurring_payment) }} VNĐ</td>
                        </tr>
                        <tr>
                            <td>Số Tiền Hoàn Trả Theo Chương Trình Hoàn Tiền: [.......................................]
                                VNĐ*</td>
                        </tr>
                        <tr>
                            <td>Khoản Thanh Toán Hàng Tháng Đã Áp Dụng Hoàn Tiền:
                                [.......................................] VNĐ*</td>
                        </tr>
                        <tr>
                            <td>Kỳ Thanh Toán Hoàn Tiền: Kỳ thanh toán thứ [.......................................]/Tất
                                cả các kỳ thanh
                                toán của Thời Hạn Vay
                            </td>
                        </tr>
                        <tr>
                            <td>(*) Chỉ áp dụng trong trường hợp Bên Vay đáp ứng đủ điều kiện của Chương Trình Hoàn Tiền
                                theo quy định
                                của Bên Cho Vay.
                            </td>
                        </tr>
                        <tr>
                            <td>5.5. Ngày Thanh Toán Đầu Tiên: <b></b></td>
                        </tr>
                        <tr>
                            <td>5.6. Ngày Thanh Toán Hàng Tháng: <b>12</b></td>
                        </tr>
                        <tr>
                            <td>5.7. Ngày Thanh Toán Cuối Cùng: 5.8. Phí Chuyển Tiền: 12,000 VNĐ</td>
                        </tr>
                    </table>
                    <b>
                        <li>6. Chuyển nhượng hoặc chuyển giao hoặc thế chấp Khoản Nợ</li>
                    </b>
                    <p>6.1. Bên Vay đồng ý rằng, theo quy định pháp luật, Bên Cho Vay có quyền chuyển nhượng hoặc chuyển
                        giao,
                        trên cơ sở truy đòi hoặc không truy đòi, Khoản Nợ quy định tại Mục 1.4 của Bản Điều Khoản Và
                        Điều Kiện
                        Chung (là một phần không tách rời của Hợp Đồng, được niêm yết công khai tại trụ sở chính, chi
                        nhánh, các
                        điểm giới thiệu dịch vụ và website ĐẠI PHÁT của Bên Cho Vay) (“Bản Điều Khoản Và Điều Kiện
                        Chung”) cùng
                        với tất cả các quyền và nghĩa vụ có liên quan cho bên thứ ba (“Bên Nhận Chuyển Nhượng”) khi (i)
                        pháp
                        luật có yêu cầu; hoặc (ii) Bên Cho Vay thực hiện mua, bán nợ; hoặc (iii) Bên Cho Vay thực

                        hiện chia, tách, hợp nhất, sáp nhập, mua bán công ty. Đối với các trường hợp khác, Bên Cho Vay
                        có quyền
                        chuyển nhượng hoặc chuyển giao Khoản Nợ cùng với tất cả các quyền và nghĩa vụ có liên quan cho
                        Bên Nhận
                        Chuyển Nhượng theo thỏa thuận với Bên Vay quy định tại Mục A.4.2.2 của Hợp Đồng.</p>
                    <p>6.2. Bên Vay đồng ý rằng, Bên Cho Vay có quyền thế chấp Khoản Nợ cùng với tất cả các quyền và
                        nghĩa vụ
                        có liên quan cho bên thứ ba được phép nhận thế chấp Khoản Nợ đó theo quy định pháp luật Việt Nam
                        (“Bên
                        Nhận Thế Chấp”).</p>
                    <p>6.3. Bên Vay cam kết sẽ hợp tác với Bên Nhận Chuyển Nhượng, Bên Nhận Thế Chấp trong việc thực
                        hiện thanh
                        toán Khoản Nợ.</p>
                    <b>
                        <li>7. Thu thập, sử dụng, chuyển giao thông tin</li>
                    </b>
                    <p>7.1. Bên Vay đồng ý rằng Bên Cho Vay có quyền thu thập, sử dụng và lưu trữ thông tin, hình ảnh
                        của Bên
                        Vay, thông tin liên quan đến Bên Vay và Khoản Nợ của Bên Vay tại Bên Cho Vay, bất kể do Bên Vay
                        cung cấp
                        hoặc do Bên Cho Vay thu thập được (bao gồm cả trường hợp yêu cầu bên thứ ba cung cấp), vì mục
                        đích thực
                        hiện Hợp Đồng này và các mục đích khác quy định tại Mục 12.3 của Bản Điều Khoản Và Điều Kiện
                        Chung.</p>
                    <p>7.2. Bên Vay đồng ý rằng:</p>
                    <div style="padding-left: 20px">
                        <p>7.2.1. Bên Cho Vay có quyền tiết lộ, cung cấp thông tin của Bên Vay, thông tin liên quan đến
                            Bên Vay và
                            Khoản Nợ của Bên Vay tại Bên Cho Vay, bất kể do Bên Vay cung cấp hoặc do Bên Cho Vay thu
                            thập được, cho
                            bên thứ ba bao gồm: (i) Trung Tâm Thông Tin Tín Dụng Quốc Gia Việt Nam (CIC) hoặc tổ chức
                            khác được phép
                            hoạt động thông tin tín dụng theo quy định của Ngân hàng nhà nước; (ii) chi nhánh, công ty
                            liên kết,
                            thành viên góp vốn của Bên Cho Vay; (iii) Bên Nhận Chuyển Nhượng, Bên Nhận Thế Chấp theo quy
                            định tại
                            Mục B.6 của Hợp Đồng này; (iv) bên môi giới, bên bảo hiểm, bên xử lý dữ liệu, bên cung cấp
                            dịch vụ pháp
                            lý, bên cung cấp dịch vụ thu hộ/dịch vụ trung gian thanh toán. Ngoài ra, Bên Cho Vay còn có
                            quyền tiết
                            lộ, cung cấp thông tin theo quy định pháp luật, theo yêu cầu của các cơ quan chức năng liên
                            quan, hoặc
                            nhằm mục đích thực hiện các công việc liên quan đến Khoản Vay.</p>
                        <p>7.2.2. Ngoài các bên thứ ba và các trường hợp tiết lộ, cung cấp thông tin quy định tại Mục
                            B.7.2.1 của
                            Hợp Đồng này, Bên Cho Vay còn có quyền tiết lộ, cung cấp thông tin của Bên Vay, thông tin
                            liên quan đến
                            Bên Vay và Khoản Nợ của Bên Vay tại Bên Cho Vay, bất kể do Bên Vay cung cấp hoặc do Bên Cho
                            Vay thu thập
                            được, cho các bên thứ ba khác theo thỏa thuận với Bên Vay quy định tại Mục A.4.2.3 của Hợp
                            Đồng.</p>
                        <p>7.2.3. Các bên thứ ba nhận thông tin từ Bên Cho Vay có nghĩa vụ bảo mật thông tin nhận được
                            theo quy
                            định pháp luật.</p>
                        <p>
                            7.2.4. Hình thức yêu cầu, hình thức cung cấp, thời hạn cung cấp, trình tự, thủ tục hồ sơ yêu
                            cầu cung
                            cấp thông tin Bên Vay cho bên thứ ba theo quy định tại Mục B.7.2.1 và B.7.2.2 của Hợp Đồng
                            này thực hiện
                            theo quy định nội bộ của Bên Cho Vay và phù hợp quy định pháp luật.</p>

                    </div>
                    <b>
                        <li>8. Bảo hiểm</li>
                    </b>
                    <p>8.1. Bên Vay đồng ý đăng ký mua sản phẩm bảo hiểm trên cơ sở đã đọc, hiểu và chấp nhận toàn bộ
                        các điều
                        kiện và điều khoản của quy tắc bảo hiểm do công ty bảo hiểm ban hành và được Bên Cho Vay công bố
                        tại
                        website <a href="http://nndbe.site/home"> www.daiphat</a> Các điều khoản và điều kiện của quy
                        tắc bảo hiểm được công bố tại website <a href="http://nndbe.site/home"> www.daiphat</a> có
                        thể được thay đổi và có giá trị áp dụng kể từ thời điểm được Bên Cho Vay cập nhật tại website
                        này mà
                        không cần thông báo trước cho Bên Vay. Bên Vay đồng ý rằng Bên Cho Vay sẽ không chịu bất kỳ
                        trách nhiệm
                        nào đối với chất lượng sản phẩm bảo hiểm.</p>
                    <p>8.2. Trường hợp Bên Vay chỉ định và/hoặc sản phẩm bảo hiểm có quy định Bên Cho Vay là người thụ
                        hưởng
                        một phần và/hoặc toàn bộ số tiền bảo hiểm, Bên Vay đồng ý công ty bảo hiểm sẽ bồi thường một
                        phần
                        và/hoặc toàn bộ số tiền bảo hiểm đó cho Bên Cho Vay.</p>
                    <b>
                        <li>9. Điều khoản chung</li>
                    </b>
                    <p>9.1. Bên Vay xác nhận và cam kết Bên Vay đã đọc, hiểu, chấp nhận tất cả các nội dung của Hợp Đồng
                        và Bản
                        Điều Khoản Và Điều Kiện Chung.</p>
                    <p>9.2. Hợp Đồng được điều chỉnh theo pháp luật nước Cộng hòa Xã hội Chủ nghĩa Việt Nam. Bất cứ thay
                        đổi
                        nào liên quan đến Hợp Đồng phải được lập thành văn bản, mọi thỏa thuận không lập bằng văn bản sẽ
                        không
                        được xem xét và chấp thuận trừ trường hợp quy định tại Mục 11.2 của Bản Điều Khoản Và Điều Kiện
                        Chung.</p>
                    <p> 9.3. Mọi tranh chấp phát sinh từ hoặc liên quan đến Hợp Đồng sẽ được giải quyết tại Tòa án nhân
                        dân có
                        thẩm quyền, trừ trường hợp các Bên có thỏa thuận khác bằng văn bản.</p>
                    <p>9.4. Hợp Đồng có hiệu lực kể từ ngày ký cho đến khi Bên Vay đã hoàn thành tất cả các nghĩa vụ
                        được quy
                        định tại Hợp Đồng này, trừ quy định tại Mục 12.3 của Bản Điều Khoản Và Điều Kiện Chung.</p>
                    <p>
                        9.5. Bên Vay đồng ý ký kết Hợp Đồng này thông qua hoặc không thông qua Dịch vụ điện tử do Bên
                        Cho Vay
                        cung cấp.Trừ trường hợp Bên Vay đề nghị vay hoặc ký kết Hợp Đồng này thông qua Ứng dụng ĐẠI PHÁT
                        Hợp Đồng này
                        phải có mã phản hồi nhanh (Quick Response Code - viết tắt là QR Code) và ký hiệu thủy vân theo
                        quy định
                        của Bên Cho Vay và nếu Hợp Đồng này không có QR Code và ký hiệu thủy vân theo quy định của Bên
                        Cho Vay
                        sẽ không có giá trị ràng buộc các Bên. Trong trường hợp này, các Bên thống nhất căn cứ nội dung
                        hợp đồng
                        có QR Code và ký hiệu thủy vân theo quy định của Bên Cho Vay đang được Bên Cho Vay và các bên
                        vay khác
                        ký kết tại cùng thời điểm.</p>
                </ol>
                <div class="footer">
                    <table class="table">
                        <tr>
                            <td style="padding-left: 30px; width: 400px"><b>Bên Cho Vay</b></td>
                            <td style="padding-left: 30px; width: 400px"><b>Bên Vay</b></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 20px;">Ký bởi: CÔNG TY TNHH TÀI CHÍNH TRÁCH</td>
                            <td style="padding-left: 0;">Ký bời: {{$loan->user->name}}</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 20px;">NHIỆM HỮU HẠN ĐẠI PHÁT</td>
                            <td style="padding-left: 0px;">Thời gian ký: {{$loan->updated_at ?? ''}}</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 20px;">Người đại diện: TRƯƠNG QUỐC HUY</td>
                            <td style="padding-left: 0;">Lý Do: Tôi đồng ý</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 20px;">Thời gian ký: {{$loan->updated_at ?? ''}}</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 20px;">Lý Do: Tôi đồng ý</td>
                            <td style="padding-left: 60px; width: 50px">
                                 <img style="width: 50px" alt="" src="{{ storage_path('app/public/'.$signature) }}" >
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left: 40px;">
                                <img style="width: 100px" alt="" src="{{public_path('/assets/img/con_dau.png')}}" >
                            </td>
                        </tr>
                    </table>
                </div>
                </p>
                <p>

            </div>
        </div>
    </div>
</body>

</html>
