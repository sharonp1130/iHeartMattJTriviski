package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final

import java.util.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

import org.hibernate.annotations.Generated;
import org.hibernate.annotations.GenerationTime;

/**
 * Settings generated by hbm2java
 */
@SuppressWarnings("serial")
@Entity
@Table(name = "settings")
public class Settings implements java.io.Serializable {

	private int settingsId;
	private Date mondayStart;
	private Date mondayEnd;
	private Date tuesdayStart;
	private Date tuesdayEnd;
	private Date wednesdayStart;
	private Date wednesdayEnd;
	private Date thursdayStart;
	private Date thursdayEnd;
	private Date fridayStart;
	private Date fridayEnd;
	private Date saturdayStart;
	private Date saturdayEnd;
	private Date sundayStart;
	private Date sundayEnd;
	private User user;
	private Date createdAt;
	private Date updatedAt;

	public Settings() {
	}

	public Settings(int settingsId, User user) {
		this.settingsId = settingsId;
		this.user = user;
	}

	public Settings(int settingsId, Date mondayStart, Date mondayEnd, Date tuesdayStart, Date tuesdayEnd,
			Date wednesdayStart, Date wednesdayEnd, Date thursdayStart, Date thursdayEnd, Date fridayStart,
			Date fridayEnd, Date saturdayStart, Date saturdayEnd, Date sundayStart, Date sundayEnd, User user) {
		this.settingsId = settingsId;
		this.mondayStart = mondayStart;
		this.mondayEnd = mondayEnd;
		this.tuesdayStart = tuesdayStart;
		this.tuesdayEnd = tuesdayEnd;
		this.wednesdayStart = wednesdayStart;
		this.wednesdayEnd = wednesdayEnd;
		this.thursdayStart = thursdayStart;
		this.thursdayEnd = thursdayEnd;
		this.fridayStart = fridayStart;
		this.fridayEnd = fridayEnd;
		this.saturdayStart = saturdayStart;
		this.saturdayEnd = saturdayEnd;
		this.sundayStart = sundayStart;
		this.sundayEnd = sundayEnd;
		this.user = user;
	}

	
	@Id
	@Column(name = "settingsId", unique = true, nullable = false)
	public int getSettingsId() {
		return this.settingsId;
	}

	public void setSettingsId(int settingsId) {
		this.settingsId = settingsId;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "mondayStart", length = 8)
	public Date getMondayStart() {
		return this.mondayStart;
	}

	public void setMondayStart(Date mondayStart) {
		this.mondayStart = mondayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "mondayEnd", length = 8)
	public Date getMondayEnd() {
		return this.mondayEnd;
	}

	public void setMondayEnd(Date mondayEnd) {
		this.mondayEnd = mondayEnd;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "tuesdayStart", length = 8)
	public Date getTuesdayStart() {
		return this.tuesdayStart;
	}

	public void setTuesdayStart(Date tuesdayStart) {
		this.tuesdayStart = tuesdayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "tuesdayEnd", length = 8)
	public Date getTuesdayEnd() {
		return this.tuesdayEnd;
	}

	public void setTuesdayEnd(Date tuesdayEnd) {
		this.tuesdayEnd = tuesdayEnd;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "wednesdayStart", length = 8)
	public Date getWednesdayStart() {
		return this.wednesdayStart;
	}

	public void setWednesdayStart(Date wednesdayStart) {
		this.wednesdayStart = wednesdayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "wednesdayEnd", length = 8)
	public Date getWednesdayEnd() {
		return this.wednesdayEnd;
	}

	public void setWednesdayEnd(Date wednesdayEnd) {
		this.wednesdayEnd = wednesdayEnd;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "thursdayStart", length = 8)
	public Date getThursdayStart() {
		return this.thursdayStart;
	}

	public void setThursdayStart(Date thursdayStart) {
		this.thursdayStart = thursdayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "thursdayEnd", length = 8)
	public Date getThursdayEnd() {
		return this.thursdayEnd;
	}

	public void setThursdayEnd(Date thursdayEnd) {
		this.thursdayEnd = thursdayEnd;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "fridayStart", length = 8)
	public Date getFridayStart() {
		return this.fridayStart;
	}

	public void setFridayStart(Date fridayStart) {
		this.fridayStart = fridayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "fridayEnd", length = 8)
	public Date getFridayEnd() {
		return this.fridayEnd;
	}

	public void setFridayEnd(Date fridayEnd) {
		this.fridayEnd = fridayEnd;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "saturdayStart", length = 8)
	public Date getSaturdayStart() {
		return this.saturdayStart;
	}

	public void setSaturdayStart(Date saturdayStart) {
		this.saturdayStart = saturdayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "saturdayEnd", length = 8)
	public Date getSaturdayEnd() {
		return this.saturdayEnd;
	}

	public void setSaturdayEnd(Date saturdayEnd) {
		this.saturdayEnd = saturdayEnd;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "sundayStart", length = 8)
	public Date getSundayStart() {
		return this.sundayStart;
	}

	public void setSundayStart(Date sundayStart) {
		this.sundayStart = sundayStart;
	}

	@Temporal(TemporalType.TIME)
	@Column(name = "sundayEnd", length = 8)
	public Date getSundayEnd() {
		return this.sundayEnd;
	}

	public void setSundayEnd(Date sundayEnd) {
		this.sundayEnd = sundayEnd;
	}

	@Column(name = "user", nullable = false)
	public User getUser() {
		return this.user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	@Generated(GenerationTime.INSERT) 
	@Temporal(TemporalType.TIMESTAMP)
	@Column(name = "created_at", length = 19, insertable=false, updatable=false)
	public Date getCreatedAt() {
		return this.createdAt;
	}

	public void setCreatedAt(Date createdAt) {
		this.createdAt = createdAt;
	}

	@Generated(GenerationTime.ALWAYS) 
	@Temporal(TemporalType.TIMESTAMP)
	@Column(name = "updated_at", length = 19, insertable=false, updatable=true)
	public Date getUpdatedAt() {
		return this.updatedAt;
	}

	public void setUpdatedAt(Date updatedAt) {
		this.updatedAt = updatedAt;
	}

}
