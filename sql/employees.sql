

SELECT 'CREATING DATABASE STRUCTURE' as 'INFO';



CREATE TABLE ee_employees (
    emp_no      INT             NOT NULL,
    birth_date  DATE            NOT NULL,
    first_name  VARCHAR(14)     NOT NULL,
    last_name   VARCHAR(16)     NOT NULL,
    gender      ENUM ('M','F')  NOT NULL,    
    hire_date   DATE            NOT NULL,
    PRIMARY KEY (emp_no)
);

CREATE TABLE ee_departments (
    dept_no     CHAR(4)         NOT NULL,
    dept_name   VARCHAR(40)     NOT NULL,
    PRIMARY KEY (dept_no),
    UNIQUE  KEY (dept_name)
);

CREATE TABLE ee_dept_manager (
   emp_no       INT             NOT NULL,
   dept_no      CHAR(4)         NOT NULL,
   from_date    DATE            NOT NULL,
   to_date      DATE            NOT NULL,
   FOREIGN KEY (emp_no)  REFERENCES ee_employees (emp_no)    ON DELETE CASCADE,
   FOREIGN KEY (dept_no) REFERENCES ee_departments (dept_no) ON DELETE CASCADE,
   PRIMARY KEY (emp_no,dept_no)
); 

CREATE TABLE ee_dept_emp (
    emp_no      INT             NOT NULL,
    dept_no     CHAR(4)         NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE            NOT NULL,
    FOREIGN KEY (emp_no)  REFERENCES ee_employees   (emp_no)  ON DELETE CASCADE,
    FOREIGN KEY (dept_no) REFERENCES ee_departments (dept_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no,dept_no)
);

CREATE TABLE ee_titles (
    emp_no      INT             NOT NULL,
    title       VARCHAR(50)     NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE,
    FOREIGN KEY (emp_no) REFERENCES ee_employees (emp_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no,title, from_date)
) 
; 

CREATE TABLE ee_salaries (
    emp_no      INT             NOT NULL,
    salary      INT             NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE            NOT NULL,
    FOREIGN KEY (emp_no) REFERENCES ee_employees (emp_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, from_date)
) 
; 

CREATE OR REPLACE VIEW dept_emp_latest_date AS
    SELECT emp_no, MAX(from_date) AS from_date, MAX(to_date) AS to_date
    FROM dept_emp
    GROUP BY emp_no;

# shows only the current department for each employee
CREATE OR REPLACE VIEW current_dept_emp AS
    SELECT l.emp_no, dept_no, l.from_date, l.to_date
    FROM dept_emp d
        INNER JOIN dept_emp_latest_date l
        ON d.emp_no=l.emp_no AND d.from_date=l.from_date AND l.to_date = d.to_date;

flush /*!50503 binary */ logs;

SELECT 'LOADING departments' as 'INFO';
source /opt/lampp/htdocs/www/BD-master/sql/load_departments.dump ;
SELECT 'LOADING employees' as 'INFO';
source /opt/lampp/htdocs/www/BD-master/sql/load_employees.dump ;
SELECT 'LOADING dept_emp' as 'INFO';
source /opt/lampp/htdocs/www/BD-master/sql/load_dept_emp.dump ;
SELECT 'LOADING dept_manager' as 'INFO';
source /opt/lampp/htdocs/www/BD-master/sql/load_dept_manager.dump ;
SELECT 'LOADING titles' as 'INFO';
source /opt/lampp/htdocs/www/BD-master/sql/load_titles.dump ;
SELECT 'LOADING salaries' as 'INFO';
source /opt/lampp/htdocs/www/BD-master/sql/load_salaries1.dump ;
source /opt/lampp/htdocs/www/BD-master/sql/load_salaries2.dump ;
source /opt/lampp/htdocs/www/BD-master/sql/load_salaries3.dump ;

source /opt/lampp/htdocs/www/BD-master/sql/show_elapsed.sql ;
