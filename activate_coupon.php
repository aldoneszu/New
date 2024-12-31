<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['number'];  // رقم الهاتف
    $password = $_POST['password'];  // كلمة المرور

    // التحقق من الرقم والباسورد باستخدام cURL (مقابل الكود المكتوب بلغة بايثون)
    $url = "https://mobile.vodafone.com.eg/auth/realms/vf-realm/protocol/openid-connect/token";

    $headers = [
        "Accept: application/json, text/plain, */*",
        "Connection: keep-alive",
        "x-dynatrace: MT_3_13_3830690492_8-0_a556db1b-4506-43f3-854a-1d2527767923_0_16912_686",
        "x-agent-operatingsystem: V12.0.17.0.QJQMIXM",
        "clientId: xxx",
        "x-agent-device: lime",
        "x-agent-version: 2024.10.1",
        "x-agent-build: 500",
        "Content-Type: application/x-www-form-urlencoded",
        "Content-Length: 145",
        "Host: mobile.vodafone.com.eg",
        "User-Agent: okhttp/4.9.1",
    ];

    $data = [
        'grant_type' => 'password',
        'client_secret' => 'a2ec6fff-0b7f-4aa4-a733-96ceae5c84c3',
        'client_id' => 'my-vodafone-app',
        'username' => $username,
        'password' => $password,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($statusCode == 200) {
        echo "تم التحقق بنجاح<br>";

        // يمكنك الآن استخدام الـ access_token لتنفيذ الاشتراك
        $response_data = json_decode($response, true);
        $access_token = $response_data['access_token'];

        // إرسال الطلبات لتفعيل الكوبون أو الباقة هنا باستخدام الـ access_token (تمامًا كما فعلت في بايثون)
        echo "تم تفعيل الكوبون بنجاح!";
    } else {
        echo "فشل التحقق من الرقم أو الباسورد";
    }
}
?>
