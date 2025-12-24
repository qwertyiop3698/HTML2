import tkinter as tk
from tkinter import messagebox

# 기본 설정
seats = [0] * 10

def reserve_seat(i):
    # 이미 예약된 경우
    if seats[i] == 1:
        messagebox.showwarning("예약 불가", f"죄송합니다. {i+1}번 좌석은 이미 예약되었습니다.")
    else:
        # 예약 처리
        seats[i] = 1
        seat_buttons[i].config(text="[X]", bg="gray", fg="white") # 버튼 상태 변경
        messagebox.showinfo("예약 완료", f"{i+1}번 좌석이 성공적으로 예약되었습니다.")

# 메인 윈도우 생성
root = tk.Tk()
root.title("극장 예약 시스템")
root.geometry("400x250")

# 제목 라벨
title_label = tk.Label(root, text="좌석을 선택해 주세요", font=("맑은 고딕", 16, "bold"))
title_label.pack(pady=20)

# 버튼들을 담을 프레임
button_frame = tk.Frame(root)
button_frame.pack()

seat_buttons = []

# 10개의 좌석 버튼 생성
for i in range(10):
    # i를 인자로 전달하기 위해 람다(lambda) 사용
    btn = tk.Button(button_frame, text=f"{i+1}", width=5, height=2, 
                    command=lambda x=i: reserve_seat(x))
    btn.grid(row=i//5, column=i%5, padx=5, pady=5) # 5개씩 2줄로 배치
    seat_buttons.append(btn)

# 종료 버튼
exit_btn = tk.Button(root, text="종료", command=root.quit, bg="red", fg="white")
exit_btn.pack(pady=20)

root.mainloop()