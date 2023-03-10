from django.contrib.auth.models import User
from django.db import models

# Create your models here.


class Branch(models.Model):
    user = models.ManyToManyField(User)
    name = models.CharField(max_length=30)
    arabic_name = models.CharField(max_length=30)
    contact = models.CharField(max_length=40)
    email = models.EmailField()
    address = models.TextField()
    vat_number = models.CharField(max_length=30)
    vat = models.FloatField()
    logo = models.TextField()

    class Meta:
        db_table = 'branch'

    def __str__(self):
        return self.name


class Employee(models.Model):
    branch = models.ForeignKey(Branch, on_delete=models.PROTECT)
    name = models.CharField(max_length=30)
    father_name = models.CharField(max_length=30)
    date_of_birth = models.DateField()
    nic = models.CharField(max_length=20)
    category = models.CharField(max_length=20)
    contact = models.CharField(max_length=20)
    address = models.TextField()
    balance = models.FloatField()
    basic_salary = models.FloatField()
    transport_allowance = models.FloatField()
    food_allowance = models.FloatField()
    accommodation_allowance = models.FloatField()
    pr_allowance = models.FloatField()
    extra_allowance = models.FloatField()
    working_hours = models.FloatField()
    hiring_date = models.DateField()
    fire_date = models.DateField()
    nationality = models.CharField(max_length=20)
    passport_number = models.CharField(max_length=30)
    passport_expiry_date = models.DateField()
    work_permit = models.CharField(max_length=30)
    work_permit_expiry_date = models.DateField()
    driving_license = models.CharField(max_length=30)
    driving_license_expiry_date = models.DateField()
    municipality_card = models.CharField(max_length=30)
    municipality_card_expiry_date = models.DateField()

    class Meta:
        db_table = 'employee'

    def __str__(self):
        return self.name
