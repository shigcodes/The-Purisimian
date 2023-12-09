<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class admin_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function login($username, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM `user` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getArticles()
    {
        $query = $this->conn->prepare("SELECT * FROM `articles`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getArticlesIndividual($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `articles` WHERE `ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewArticle($post, $file)
    {
        $category = $post['articleCategory'];
        $title = $post['articleTitle'];
        $article = $post['article'];

        $photoId = mt_rand(10000, 99999);
        if (!empty($_FILES['articlePhoto']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
                $destinationDirectory = '../assets/articles/';
                $newFileName = $photoId . '.' . $extension;
                $destination = $destinationDirectory . $newFileName;
                if (is_uploaded_file($file_tmp)) {
                    if (move_uploaded_file($file_tmp, $destination)) {
                        $query = $this->conn->prepare("INSERT INTO `articles`(`CATEGORY`, `TITLE`, `ARTICLE`, `PHOTO`) VALUES (?, ?, ?, ?)");
                        $query->bind_param("ssss", $category, $title, $article, $newFileName);
                        if ($query->execute()) {
                            return 200;
                        } else {
                            return 405;
                        }
                    } else {
                        return 'Uploading file unsuccessfull';
                    }
                } else {
                    return "Error: File upload failed or file not found.";
                }
            } else {
                return 'Invalid file type';
            }
        } else {
            return 'File is empty';
        }
    }

    public function editArticle($post, $file)
    {
        $articleId = $post['articleId'];
        $EditArticle = $post['EditArticle'];
        $EditArticleTitle = $post['EditArticleTitle'];
        $EditArticleCategory = $post['EditArticleCategory'];

        $getArticle = $this->getArticlesIndividual($articleId);
        if ($getArticle->num_rows > 0) {
            $article = $getArticle->fetch_assoc();
            $articleCurrentPhoto = $article['PHOTO'];

            $photoId = mt_rand(10000, 99999);
            if (!empty($_FILES['articlePhoto']['size'])) {
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
                    $destinationDirectory = '../assets/articles/';
                    $newFileName = $photoId . '.' . $extension;
                    $destination = $destinationDirectory . $newFileName;
                    $fileToDelete = '../assets/articles/' . $articleCurrentPhoto;

                    if (is_uploaded_file($file_tmp)) {
                        if (move_uploaded_file($file_tmp, $destination) && unlink($fileToDelete)) {
                            $query = $this->conn->prepare("UPDATE `articles` SET `CATEGORY`=?, `TITLE`=?, `ARTICLE`=?, `PHOTO`=? WHERE `ID` = ?");
                            $query->bind_param("ssssi", $EditArticleCategory, $EditArticleTitle, $EditArticle, $newFileName, $articleId);

                            if ($query->execute()) {
                                return 200;
                            } else {
                                return 405;
                            }
                        } else {
                            return 'Uploading file unsuccessfull';
                        }
                    } else {
                        return "Error: File upload failed or file not found.";
                    }
                } else {
                    return 'Invalid file type';
                }
            } else {
                $query = $this->conn->prepare("UPDATE `articles` SET `CATEGORY`=?, `TITLE`=?, `ARTICLE`=? WHERE `ID` = ?");
                $query->bind_param("sssi", $EditArticleCategory, $EditArticleTitle, $EditArticle, $articleId);
                if ($query->execute()) {
                    return 200;
                } else {
                    return 405;
                }
            }
        } else {
            return 'No article found!';
        }
    }

    public function deleteArticle($id)
    {
        $getArticle = $this->getArticlesIndividual($id);
        if ($getArticle->num_rows > 0) {
            $article = $getArticle->fetch_assoc();
            $photoName = $article['PHOTO'];
            $fileToDelete = '../assets/articles/' . $photoName;
            $query = $this->conn->prepare("DELETE FROM `articles` WHERE `ID` = '$id'");
            if (unlink($fileToDelete) && $query->execute()) {
                return 200;
            } else {
                return 400;
            }
        } else {
            return 400;
        }
    }
}
