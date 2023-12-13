<?php

class SubmissionHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSubmissionId() {
        if (isset($_POST['submission_id'])) {
            $submissionId = $_POST['submission_id'];

            $stmt = $this->conn->prepare("SELECT * FROM usersubmissions WHERE submission_id = :submission_id");
            $stmt->bindParam(':submission_id', $submissionId, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && isset($row['submission_id'])) {
                return $row;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
?>
