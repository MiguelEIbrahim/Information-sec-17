# myproject/urls.py
from django.urls import path
from myapp.views import SignUpView

urlpatterns = [
    # Other paths...
    path('signup/', SignUpView.as_view(), name='signup'),
]
