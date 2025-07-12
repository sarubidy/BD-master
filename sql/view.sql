    CREATE OR REPLACE view v_list as
    SELECT employees.gender as gn,dept_emp.dept_no as num,employees.birth_date AS anniv ,employees.emp_no AS numero ,employees.first_name, employees.last_name FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON departments.dept_no = dept_emp.dept_no;


CREATE OR REPLACE VIEW v_count_emp AS
SELECT  dept_emp.dept_no AS num,employees.gender AS gn,COUNT(employees.emp_no) AS total FROM employees
JOIN dept_emp ON employees.emp_no = dept_emp.emp_no;

