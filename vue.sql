CREATE OR REPLACE VIEW v_employees_title_gender AS 
SELECT 
    employees.emp_no,
    gender,
    title
FROM titles JOIN employees
ON titles.emp_no = employees.emp_no;

CREATE OR REPLACE VIEW v_avg_salaire_emploi AS
SELECT
    title,
    avg(salary) as avgSalary
FROM titles JOIN salaries 
ON titles.emp_no = salaries.emp_no;

CREATE OR REPLACE VIEW emploiInfo AS
SELECT 
    v_employees_title_gender.emp_no,
    v_employees_title_gender.title,
    v_employees_title_gender.gender,
    v_avg_salaire_emploi.avgSalary
FROM v_employees_title_gender JOIN v_avg_salaire_emploi
ON v_employees_title_gender.title = v_avg_salaire_emploi.title;