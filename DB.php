<?=
require_once 'DB_connection.php';

class DB {
    private $db;

    public function __construct() {
        $this->db = (new DBConnection())->getConnection();
    }


    public function getTasks() {
        $sql = "SELECT * FROM todos ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addTask($task) {
        $task = trim($task);
        if (!empty($task)) {
            $stmt = $this->db->prepare("INSERT INTO todos (tasks) VALUES (:task)");
            $stmt->bindParam(':task', $task, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    

    
    public function deleteTask($id) {
        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
