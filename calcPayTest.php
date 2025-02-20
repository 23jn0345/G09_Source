<?php
require_once 'DAO/PaymentDAO.php';
require_once 'DAO/subscDAO.php';
require_once 'DAO/usingSubscDAO.php';
session_start();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>今月の支払予定</title>
    <!-- スタイルシートは省略 -->
</head>
<body>
    <div class="container">
        <?php
        try {
            // PaymentDAOのインスタンス化
            $paymentDAO = new PaymentDAO();
            
            // 現在の年月とユーザーID取得
            $currentYear = date('Y');
            $currentMonth = date('m');
            $raigetu =  $currentMonth->add(new DateInterval('P1D'));
            $userID = $_SESSION['member']->ID;
            
            // 支払い情報の計算
            $result = $paymentDAO->calculate_MonthlyPayments($userID, $currentYear, $currentMonth);
            $monthlyTotal = $result['total'];
            $paymentDetails = $result['details'];
        ?>

            <h2><?php echo $currentYear; ?>年<?php echo $currentMonth; ?>月の支払予定</h2>
            
            <div class="total-amount">
                合計金額: <?php echo number_format($monthlyTotal); ?>円
            </div>

            <?php if (!empty($paymentDetails)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>サービス名</th>
                            <th>支払予定日</th>
                            <th>支払間隔</th>
                            <th>金額</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paymentDetails as $detail): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($detail['SubName']); ?></td>
                                <td><?php echo $detail['PaymentDate']; ?></td>
                                <td><?php echo $detail['Interval']; ?></td>
                                <td class="price"><?php echo number_format($detail['Price']); ?>円</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>今月の支払い予定はありません。</p>
            <?php endif; ?>

        <?php
        } catch (Exception $e) {
            echo "<p>エラーが発生しました。管理者にお問い合わせください。</p>";
        }
        ?>
    </div>
</body>
</html>