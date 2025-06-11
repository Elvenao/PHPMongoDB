<?php
    $dir = __DIR__;
    
    $filePath = $dir . '/../vendor/autoload.php';
    require $filePath;

    use MongoDB\Client;
    use MongoDB\Collection;
    use MongoDB\BSON\ObjectId;
    class MainModel {
        private Client $client;
        private string $databaseName;

        /**
         * Constructor: inicializa el cliente MongoDB y define la base de datos.
         *
         * @param string $uri          URI de conexión, p.ej. "mongodb://localhost:27017"
         * @param string $databaseName Nombre de la base de datos a usar
         */
        public function __construct(string $uri = 'mongodb://localhost:27017', string $databaseName = 'miApp') {
            // Configura Autoload de Composer
            // (puede omitirse si ya se hace antes de instanciar esta clase)
            // require_once __DIR__ . '/../../vendor/autoload.php';

            $this->databaseName = $databaseName;
            $this->client = new MongoDB\Client($uri);
        }

        /**
         * Summary of findDocuments
         * @param string $dataBase
         * @param string $collection
         * @return \MongoDB\Collection
         */

        public function findDocuments(string $collection){
            return $this->client->selectDatabase($this->databaseName)->selectCollection($collection);
        }


        /**
         * Agrega un documento JSON a la colección especificada.
         *
         * @param string $collectionName Nombre de la colección
         * @param string $documentJson   Documento JSON como cadena
         * @return \MongoDB\InsertOneResult
         * @throws \InvalidArgumentException si el JSON no es válido
         */
        public function addDocument(string $collectionName, string $documentJson) {
            // Decodificar JSON a array asociativo
            $documentArray = json_decode($documentJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \InvalidArgumentException('JSON inválido: ' . json_last_error_msg());
            }

            // Obtener la colección deseada
            $collection = $this->client
                ->selectDatabase($this->databaseName)
                ->selectCollection($collectionName);

            // Insertar el documento y retornar el resultado
            return $collection->insertOne($documentArray);
        }

        public function deleteDocument(string $collectionName, string $id){
            $collection = $this->client
                ->selectDatabase($this->databaseName)
                ->selectCollection($collectionName);
                return $collection->deleteOne(['_id' => new ObjectId($id)]);
        }
    }
