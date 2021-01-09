<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
	private $table = 'mahasiswa';

	public function up()
	{
		$this->forge->addField([
			'nim'          => [				// nama kolom
					'type'           => 'VARCHAR',
					'constraint'     => 9,
			],
			'nama_mahasiswa'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
			],
			'jenis_kelamin' => [
					'type'           => 'ENUM',
					'constraint'     => ['Pria','Wanita'],
					'default'		 => 'Pria'
			],
			'kode_agama'				=> [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'		 => TRUE,
					'auto_increment' => TRUE,
			],
			'alamat'			=> [
					'type'			=> 'TEXT',
			],
			'foto'				 => [
				'type'			 => 'TEXT',
			],
			'tempat_lahir'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'tanggal_lahir'     => [
				'type'           => 'DATE',
			],
		]);

		$this->forge->addKey('nim', true); // maksudnya ini primary key
		$this->forge->addForeignKey('kode_agama','agama','kode_agama','CASCADE','CASCADE'); // menambahkan foregn key
		$this->forge->createTable($this->table);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
