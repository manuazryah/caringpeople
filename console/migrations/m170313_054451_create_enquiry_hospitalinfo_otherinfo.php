<?php

use yii\db\Migration;

class m170313_054451_create_enquiry_hospitalinfo_otherinfo extends Migration {

	public function up() {
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		//Enquiry table//
		$this->createTable('{{%enquiry}}', [
		    'id' => $this->primaryKey(),
		    'number' => $this->integer(),
		    'contacted_by' => $this->integer()->comment('1=Phone,2=Email,3=Other'),
		    'contacted_date' => $this->date(),
		    'contacted_time' => $this->string(100),
		    'incoming_call' => $this->string(100),
		    'missed_call' => $this->string(100),
		    'call_date' => $this->date(),
		    'call_time' => $this->string(100),
		    'outgoing_call_from' => $this->string(100),
		    'outgoing_call_date' => $this->date(),
		    'outgoing_call_time' => $this->string(100),
		    'name_of_caller' => $this->string(100),
		    'referral_source' => $this->string(100),
		    'mobile_number' => $this->string(100),
		    'mobile_number_2' => $this->string(100),
		    'mobile_number_3' => $this->string(100),
		    'address' => $this->string(200),
		    'city' => $this->string(100),
		    'zip_pc' => $this->string(100),
		    'email' => $this->string(100),
		    'name_of_person_requiring_service' => $this->string(100),
		    'age' => $this->integer(),
		    'weight' => $this->integer(),
		    'relationship' => $this->integer()->comment('1=Spouse,2=Parent,3=Grandparent,4=Other'),
		    'veteran_or_spouse' => $this->integer()->comment('1=Yes,0=No'),
		    'person_address' => $this->string(200),
		    'person_city' => $this->string(100),
		    'person_postal_code' => $this->string(100),
		    'branch_id' => $this->integer()->notNull(),
		    'status' => $this->smallInteger()->notNull(),
		    'CB' => $this->integer()->notNull(),
		    'UB' => $this->integer()->notNull(),
		    'DOC' => $this->date(),
		    'DOU' => $this->timestamp(),
			], $tableOptions);


		// enquiry_hospital_doctor_info

		$this->createTable('{{%enquiry_hospital_doctor_info}}', [
		    'id' => $this->primaryKey(),
		    'enquiry_id' => $this->integer()->notNull(),
		    'hospital' => $this->string(200),
		    'consultant_doctor' => $this->string(200),
		    'hospital_room_no' => $this->string(200),
		    'required_service' => $this->string(200),
		    'other_services' => $this->string(200),
		    'diabetic' => $this->string(200),
		    'hypertension' => $this->string(200),
		    'tubes' => $this->string(200),
		    'feeding' => $this->string(200),
		    'urine' => $this->string(200),
		    'oxygen' => $this->string(200),
		    'tracheostomy' => $this->string(200),
		    'iv_line' => $this->string(200),
		    'dressing' => $this->string(200),
		    'home_or_hospital_visit' => $this->string(200),
		    'visit_date' => $this->string(200),
		    'visit_time' => $this->string(200),
		    'bedridden' => $this->string(200),
		    'CB' => $this->integer()->notNull(),
		    'UB' => $this->integer()->notNull(),
		    'DOC' => $this->date(),
		    'DOU' => $this->timestamp(),
			], $tableOptions);

		$this->addForeignKey("enquiryid", "enquiry_hospital_doctor_info", "enquiry_id", "enquiry", "id", "RESTRICT", "RESTRICT");

		// enquiry_other_info

		$this->createTable('{{%enquiry_other_info}}', [
		    'id' => $this->primaryKey(),
		    'enquiry_id' => $this->integer()->notNull(),
		    'family_support' => $this->integer()->comment('1=Close,2=Distant,3=None'),
		    'family_support_note' => $this->string(200),
		    'care_currently_provided' => $this->integer()->comment('1=Family,2=Friends,3=Provincial HC,4=Insurance,5=Private,6=VAC'),
		    'details_of_current_care' => $this->string(200),
		    'difficulty_in_movement' => $this->integer()->comment('1=No difficulty,2=Assistance required,3=Wheelchair,4=Bedridden,5=Other'),
		    'difficulty_in_movement_other' => $this->string(200),
		    'service_required' => $this->integer()->comment('1=Immediately,2=Couple weeks,3=Month,4=UNSURE,5=Other'),
		    'service_required_other' => $this->string(200),
		    'how_long_service_required' => $this->string(200),
		    'follow_up_notes' => $this->text(),
		    'quotation_details' => $this->text(),
		    'priority' => $this->integer(),
		    'followup_date' => $this->date(),
		    'CB' => $this->integer()->notNull(),
		    'UB' => $this->integer()->notNull(),
		    'DOC' => $this->date(),
		    'DOU' => $this->timestamp(),
			], $tableOptions);

		$this->addForeignKey("enquiry_id", "enquiry_other_info", "enquiry_id", "enquiry", "id", "RESTRICT", "RESTRICT");

		$this->addColumn('admin_users', 'branch_id', 'INTEGER NOT NULL AFTER phone_number');
		$this->addForeignKey('fk-admin_users-branch', 'admin_users', 'branch_id', 'branch', 'id', 'CASCADE');
	}

	public function down() {
		echo "m170313_054451_create_enquiry_hospitalinfo_otherinfo cannot be reverted.\n";

		return false;
	}

	/*
	  // Use safeUp/safeDown to run migration code within a transaction
	  public function safeUp()
	  {
	  }

	  public function safeDown()
	  {
	  }
	 */
}
