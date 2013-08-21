PDO Database Class
=================

Veritabanı ayarlarını yapmak için config.php dosyasındaki ayarları kendi veri tabanı ayarlarınızıyapın.
```php
		$this->dbConfig['host'] = 'yourhostname';
        $this->dbConfig['username'] = 'yourusername';
        $this->dbConfig['password'] = 'secretpassword';
        $this->dbConfig['dbname'] = 'databasename';
```
Basit kullanımıları
-------------------
	insert sorgusu
```php
			require_once 'includes/class.database.php';
			$db = new Database;
			$userArray = array(
			'username' => 'deneme1',
			'password' => '123456',
			'full_name' => 'Deneme DENEME',
			'email' => 'deneme1@deneme.com',
			'auth' => 'user',
			'lang' => 'tr'
			);
			$table = "users";
			$db->insert($table, $userArray);
```
	update sorgusu:
```php
			require_once 'includes/class.database.php';
			$db = new Database;
			$userArray = array(
			'username' => 'deneme1',
			'password' => '1234',
			'full_name' => 'Deneme DENEME',
			'email' => 'deneme1@deneme.com',
			'auth' => 'user',
			'lang' => 'en'
			);
			$id=3;
			$table = "users";
			$db->update($table,$id, $userArray);
```
	Delete sorgusu:
```php
			require_once 'includes/class.database.php';
			$db = new Database;
			$id=3;
			$table = "users";
			$db->delete($table,$id);
```
	Count sorgusu:
```php
			require_once 'includes/class.database.php';
			$db = new Database;
			$table = "users";
			$db->count($table);
```
---------------
Alttaki sorgularda mevcut onların kullanımını sonra açıklayacağım
---------------
	Select and sorgusu:
	Select or sorgusu:
	Select and limit sorgusu:
	Select or limit sorgusu:
---------------
http://fatihgol.com
