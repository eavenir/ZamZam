# Generated by Django 4.1.7 on 2023-03-07 09:57

from django.conf import settings
from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
        ("company", "0005_employee"),
    ]

    operations = [
        migrations.DeleteModel(
            name="Company",
        ),
        migrations.AddField(
            model_name="bracnch",
            name="user",
            field=models.ManyToManyField(to=settings.AUTH_USER_MODEL),
        ),
    ]
