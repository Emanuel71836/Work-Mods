<?php
// Inclua o SDK do Firebase Admin para PHP (você precisa instalá-lo via Composer)
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

// ----- CONFIGURAÇÃO DO FIREBASE (SUBSTITUA PELO SEU) -----
// O caminho para o seu arquivo de credenciais JSON do Firebase Admin SDK
$serviceAccount = 'Caminho/para/seu/firebase-service-account.json';

// Inicie o Firebase Admin SDK
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->createFirestore();

$database = $firebase->database();

// ----- CONFIGURAÇÃO DO UPLOAD DE ARQUIVOS -----
$uploadDir = 'uploads/'; // Pasta onde os arquivos serão salvos
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Cria a pasta se ela não existir
}

// ----- PROCESSAR OS DADOS DO FORMULÁRIO -----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modName = $_POST['mod-name'];
    $modDescription = $_POST['mod-description'];
    $modCategory = $_POST['mod-category'];

    try {
        // ----- UPLOAD DA THUMBNAIL -----
        $thumbnailFile = $_FILES['mod-thumbnail'];
        $thumbnailPath = $uploadDir . basename($thumbnailFile['name']);
        if (move_uploaded_file($thumbnailFile['tmp_name'], $thumbnailPath)) {
            $thumbnailUrl = 'http://seu-site.com/' . $thumbnailPath; // Substitua por seu domínio
        } else {
            throw new Exception("Erro ao fazer o upload da thumbnail.");
        }

        // ----- UPLOAD DO ARQUIVO DO MOD -----
        $modFile = $_FILES['mod-file'];
        $modFilePath = $uploadDir . basename($modFile['name']);
        if (move_uploaded_file($modFile['tmp_name'], $modFilePath)) {
            $modFileUrl = 'http://seu-site.com/' . $modFilePath; // Substitua por seu domínio
        } else {
            throw new Exception("Erro ao fazer o upload do arquivo do mod.");
        }

        // ----- SALVAR NO FIRESTORE -----
        $newModData = [
            'name' => $modName,
            'description' => $modDescription,
            'category' => $modCategory,
            'thumbnailUrl' => $thumbnailUrl,
            'fileUrl' => $modFileUrl,
            'createdAt' => new DateTime()
        ];

        $collectionReference = $database->collection('mods');
        $collectionReference->add($newModData);

        // Redireciona o usuário para uma página de sucesso
        header('Location: sucesso.html');
        exit();

    } catch (Exception $e) {
        // Em caso de erro, exibe uma mensagem
        echo "<h1>Erro ao publicar o mod</h1>";
        echo "<p>Detalhes: " . $e->getMessage() . "</p>";
        echo '<a href="postar.html">Voltar</a>';
    }
}
?>
