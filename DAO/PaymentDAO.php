<?php
require_once 'DAO.php';  // 基本的なDB接続用クラス

class PaymentDAO {
    // 特定ユーザーの支払い情報を取得
    public function get_payment_Info($userID) {
        try {
            $dbh = DAO::get_db_connect();  // DB接続取得
            
            // SQL文の準備
            $sql = "
                SELECT 
                    s.SubName,
                    p.Price,
                    us.NextPay,
                    k.date as PaymentInterval
                FROM usingsubsc us
                JOIN subsc s ON us.SubID = s.SubID
                JOIN subscplan p ON us.PlanID = p.PlanID
                JOIN kikan k ON p.IntervalID = k.KikanID
                WHERE us.ID = :userID
            ";
            
            // SQLの実行準備
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            // 結果を配列で返す
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("データベースエラー: " . $e->getMessage());
            throw $e;
        }
    }

    // 支払い予定を計算
    public function calculate_MonthlyPayments($userID, $year, $month) {
        try {
            // 支払い情報の取得
            $paymentInfo = $this->get_payment_Info($userID);
            $monthlyTotal = 0;
            $paymentDetails = [];
            
            // 各サブスクの支払い計算
            foreach ($paymentInfo as $row) {
                $baseDate = new DateTime($row['NextPay']);
                $interval = new DateInterval('P' . $row['PaymentInterval'] . 'D');
                $currentDate = new DateTime("$year-$month-01");

              


                while ($baseDate <= $currentDate) {
                    $paymentMonth = $baseDate->format('Y-m');
                    $currentYearMonth = $currentDate->format('Y-m');
                    var_dump("paymentMonth..",$paymentMonth);
                    var_dump("currentYearMonth..",$currentYearMonth);

                    if ($paymentMonth === $currentYearMonth) {
                        $monthlyTotal += $row['Price'];
                        $paymentDetails[] = [
                            'SubName' => $row['SubName'],
                            'Price' => $row['Price'],
                            'PaymentDate' => $baseDate->format('Y-m-d'),
                            'Interval' => $row['PaymentInterval'] . '日'
                        ];
                        break;
                    }
                    $baseDate->add($interval);
                    $baseDate->add(new DateInterval('P1D')); 
                    var_dump("baseDate..",$baseDate);
                }
            }
            
            return [
                'total' => $monthlyTotal,
                'details' => $paymentDetails
            ];
            
        } catch (Exception $e) {
            error_log("計算エラー: " . $e->getMessage());
            throw $e;
        }
    }
}