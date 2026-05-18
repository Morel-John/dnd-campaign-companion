<?php
class Logbook
{
    public function __construct(
        public string $date,
        public string $title,
        public string $story,
        public string $image,
        public ?int $id = null
    ) {}

    public static function getAll($pdo)
    {
        $sql = "SELECT *
                From logbook";
        return prepSql($pdo, $sql)->fetchAll();
    }

    public static function getById($pdo, int $id)
    {
        $sql = "SELECT * 
                FROM logbook
                WHERE logbookId =:id";

        return prepSql($pdo, $sql, ['id' => $id])->fetch();
    }

    public static function create($pdo, array $data): bool
    {
        try {
            $sql = "INSERT INTO logbook (date, title, story, image)
                    VALUES (:date, :title, :story, :image)";
            ## do i need values?
            $stmt = prepSql($pdo, $sql, [
                'title' => $data['title'],
                'story' => $data['story'],
                'date'  => $data['date'],
                'image' => $data['image']
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function update($pdo, array $data)
    {
        try {
            $sql = "UPDATE logbook
                    SET title =:title,
                        story =:story,
                        date =:date,
                        image =:image
                    WHERE logbookId =:logbookId";
            $stmt = prepSql($pdo, $sql, [
                'logbookId' => $data['logbookId'],
                'title'     => $data['title'],
                'story'     => $data['story'],
                'date'      => $data['date'],
                'image'     => $data['image']
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function delete($pdo, int $id):bool
    {
        try {
            $sql = "DELETE FROM logbook
                    WHERE logbookId=?";
            $stmt = prepSql($pdo, $sql, [$id]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
