CREATE TABLE Member(
	MemberId varchar(50) NOT NULL PRIMARY KEY,
	MemberName nvarchar(50) NOT NULL,
	Zipcode varchar(8) NOT NULL,
	Address nvarchar(100) NOT NULL,
	Tel varchar(20) NULL,
	Password varchar(20) NOT NULL
)
insert into Member values('jec01@jec.ac.jp','�d�q���Y','169-8522','�����s�V�h��S�l��1-25-4','03-3369-9333','jec001')
insert into Member values('jec02@jec.ac.jp','�d�q�Ԏq','350-0841','��ʌ���z�s�䐬��1-2-3','049-222-3344','jec002')
insert into Member values('jec03@jec.ac.jp','�R��Y','115-0045','�����s�k��ԉH5-6','03-1122-3456','jec003')
insert into Member values('jec04@jec.ac.jp','����݂ǂ�','210-0808','�_�ސ쌧���s���戮��8-9','044-9876-5432','jec004')