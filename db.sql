/* mysql -u root gis_k22 -p < db.sql */
DROP TABLE IF EXISTS markers;
CREATE TABLE markers (
    id MEDIUMINT NOT NULL AUTO_INCREMENT,
    title varchar(256) NOT NULL,
    lat DECIMAL(11, 8) NOT NULL,
    lng DECIMAL(11, 8) NOT NULL,
    content TEXT NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;
INSERT INTO markers VALUES (NULL, 'Đại học Cần Thơ - Khu 2', 10.0309759, 105.7695842, '<div>Đại học Cần Thơ (ĐHCT), cơ sở đào tạo đại học và sau đại học trọng điểm của Nhà nước ở ĐBSCL, là trung tâm văn hóa - khoa học kỹ thuật  của vùng. Trường đã không ngừng hoàn thiện và phát triển, từ  một số ít ngành đào tạo ban đầu, Trường đã củng cố, phát triển thành một trường đa ngành đa lĩnh vực. Hiện nay Trường đào tạo 93 chuyên ngành đại học, 34 chuyên ngành cao học, 13 chuyên ngành nghiên cứu sinh và 02 chuyên ngành cao đẳng.</div><div><img src="/imgs/ctu-congchinh.jpg" width="250"></div>');
INSERT INTO markers VALUES (NULL, 'Đại học Cần Thơ - Khu 3', 10.033925, 105.779673, '<div>Khoa Công nghệ Thông tin và Truyền thông (CNTT&TT) - Trường Đại học Cần Thơ được thành lập năm 1994 trên cơ sở Trung tâm Điện tử và Tin học. Nhiệm vụ  của khoa là đào tạo đại học, sau đại học, nghiên cứu khoa học và chuyển giao công nghệ trong lĩnh vực CNTT&TT.</div><div><img src="/imgs/khu2-khoa.jpg" width="250"></div>');
INSERT INTO markers VALUES (NULL, 'Đại học Cần Thơ - Khu 1', 10.0193249, 105.7665439, '<div>Đại học Cần Thơ khu 1.</div>');

DROP TABLE IF EXISTS DiaGioiTinh;
CREATE TABLE DiaGioiTinh (
    id VARCHAR(20) NOT NULL,
    poly POLYGON NOT NULL
) DEFAULT CHARSET=utf8;