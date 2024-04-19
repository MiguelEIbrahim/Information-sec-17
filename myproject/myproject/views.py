from django.shortcuts import render
from django.views import View

class SignUpView(View):
    def get(self, request):
        # Add your signup logic here
        return render(request, 'signup.html')
