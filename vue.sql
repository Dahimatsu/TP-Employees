-- Vue info emp
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

-- Vue departement
CREATE VIEW v_departement AS
SELECT 
    d.dept_no AS Numero,
    d.dept_name AS Departement,
    CONCAT(e.first_name, ' ', e.last_name) AS Manager,
    COUNT(de.emp_no) AS nb_employes
FROM 
    departments d
JOIN 
    dept_manager dm ON d.dept_no = dm.dept_no
JOIN 
    employees e ON dm.emp_no = e.emp_no
JOIN 
    current_dept_emp de ON d.dept_no = de.dept_no
WHERE 
    dm.to_date = '9999-01-01'
GROUP BY 
    d.dept_no, d.dept_name, e.first_name, e.last_name
ORDER BY 
    d.dept_no;

-- Vue employe
CREATE VIEW v_employes AS
SELECT 
    e.emp_no,
    CONCAT(e.first_name, ' ', e.last_name) AS full_name,
    d.dept_no,
    d.dept_name
FROM 
    employees e
JOIN 
    current_dept_emp de ON e.emp_no = de.emp_no AND de.to_date = '9999-01-01'
JOIN 
    departments d ON de.dept_no = d.dept_no;
