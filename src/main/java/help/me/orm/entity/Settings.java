package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final


import javax.persistence.Column;
import javax.persistence.Embeddable;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.OneToOne;
import javax.persistence.Table;
import javax.persistence.Transient;

import org.hibernate.annotations.GenericGenerator;
import org.hibernate.search.annotations.Field;
import org.hibernate.search.annotations.NumericField;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;

/**
 * Settings generated by hbm2java
 */
@SuppressWarnings("serial")
@Entity
@Embeddable
@Table(name = "settings")
public class Settings implements java.io.Serializable {
	
	@JsonIgnore
	private int settingsId;

	@JsonIgnore
	private User user;

	@JsonIgnore
	private Long createdAt;
	@JsonIgnore
	private Long updatedAt;

	@Field
	@NumericField
	@JsonProperty("mondayStart")
	private Integer mondayStart;

	@Field
	@NumericField
	@JsonProperty("mondayEnd")
	private Integer mondayEnd;

	@Field
	@NumericField
	@JsonProperty("tuesdayStart")
	private Integer tuesdayStart;

	@Field
	@NumericField
	@JsonProperty("tuesdayEnd")
	private Integer tuesdayEnd;

	@Field
	@NumericField
	@JsonProperty("wednesdayStart")
	private Integer wednesdayStart;

	@Field
	@NumericField
	@JsonProperty("wednesdayEnd")
	private Integer wednesdayEnd;

	@Field
	@NumericField
	@JsonProperty("thursdayStart")
	private Integer thursdayStart;

	@Field
	@NumericField
	@JsonProperty("thursdayEnd")
	private Integer thursdayEnd;

	@Field
	@NumericField
	@JsonProperty("fridayStart")
	private Integer fridayStart;

	@Field
	@NumericField
	@JsonProperty("fridayEnd")
	private Integer fridayEnd;

	@Field
	@NumericField
	@JsonProperty("saturdayStart")
	private Integer saturdayStart;

	@Field
	@NumericField
	@JsonProperty("saturdayEnd")
	private Integer saturdayEnd;

	@Field
	@NumericField
	@JsonProperty("sundayStart")
	private Integer sundayStart;

	@Field
	@NumericField
	@JsonProperty("sundayEnd")
	private Integer sundayEnd;

	public Settings() {
	}

	public Settings(int settingsId, User user) {
		this.settingsId = settingsId;
		this.user = user;
	}

	public Settings(int settingsId, Integer mondayStart, Integer mondayEnd, Integer tuesdayStart, Integer tuesdayEnd,
			Integer wednesdayStart, Integer wednesdayEnd, Integer thursdayStart, Integer thursdayEnd, Integer fridayStart,
			Integer fridayEnd, Integer saturdayStart, Integer saturdayEnd, Integer sundayStart, Integer sundayEnd, User user, Long createdAt, Long updatedAt) {
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
		this.createdAt = createdAt;
		this.updatedAt = updatedAt;
	}
	
	@Id
	@GeneratedValue(generator="settingsIncrement")
	@GenericGenerator(name="settingsIncrement", strategy = "increment")
	@Column(name = "settingsId", unique = true, nullable = false)
	public int getSettingsId() {
		return this.settingsId;
	}

	public void setSettingsId(int settingsId) {
		this.settingsId = settingsId;
	}

	@Column(name = "mondayStart", length = 1)
	public Integer getMondayStart() {
		return this.mondayStart;
	}

	public void setMondayStart(Integer mondayStart) {
		this.mondayStart = mondayStart;
	}

	@Column(name = "mondayEnd", length = 1)
	public Integer getMondayEnd() {
		return this.mondayEnd;
	}

	public void setMondayEnd(Integer mondayEnd) {
		this.mondayEnd = mondayEnd;
	}

	@Column(name = "tuesdayStart", length = 1)
	public Integer getTuesdayStart() {
		return this.tuesdayStart;
	}

	public void setTuesdayStart(Integer tuesdayStart) {
		this.tuesdayStart = tuesdayStart;
	}

	@Column(name = "tuesdayEnd", length = 1)
	public Integer getTuesdayEnd() {
		return this.tuesdayEnd;
	}

	public void setTuesdayEnd(Integer tuesdayEnd) {
		this.tuesdayEnd = tuesdayEnd;
	}

	@Column(name = "wednesdayStart", length = 1)
	public Integer getWednesdayStart() {
		return this.wednesdayStart;
	}

	public void setWednesdayStart(Integer wednesdayStart) {
		this.wednesdayStart = wednesdayStart;
	}

	@Column(name = "wednesdayEnd", length = 1)
	public Integer getWednesdayEnd() {
		return this.wednesdayEnd;
	}

	public void setWednesdayEnd(Integer wednesdayEnd) {
		this.wednesdayEnd = wednesdayEnd;
	}

	@Column(name = "thursdayStart", length = 1)
	public Integer getThursdayStart() {
		return this.thursdayStart;
	}

	public void setThursdayStart(Integer thursdayStart) {
		this.thursdayStart = thursdayStart;
	}

	@Column(name = "thursdayEnd", length = 1)
	public Integer getThursdayEnd() {
		return this.thursdayEnd;
	}

	public void setThursdayEnd(Integer thursdayEnd) {
		this.thursdayEnd = thursdayEnd;
	}

	@Column(name = "fridayStart", length = 1)
	public Integer getFridayStart() {
		return this.fridayStart;
	}

	public void setFridayStart(Integer fridayStart) {
		this.fridayStart = fridayStart;
	}

	@Column(name = "fridayEnd", length = 1)
	public Integer getFridayEnd() {
		return this.fridayEnd;
	}

	public void setFridayEnd(Integer fridayEnd) {
		this.fridayEnd = fridayEnd;
	}

	@Column(name = "saturdayStart", length = 1)
	public Integer getSaturdayStart() {
		return this.saturdayStart;
	}

	public void setSaturdayStart(Integer saturdayStart) {
		this.saturdayStart = saturdayStart;
	}

	@Column(name = "saturdayEnd", length = 1)
	public Integer getSaturdayEnd() {
		return this.saturdayEnd;
	}

	public void setSaturdayEnd(Integer saturdayEnd) {
		this.saturdayEnd = saturdayEnd;
	}

	@Column(name = "sundayStart", length = 1)
	public Integer getSundayStart() {
		return this.sundayStart;
	}

	public void setSundayStart(Integer sundayStart) {
		this.sundayStart = sundayStart;
	}

	@Column(name = "sundayEnd", length = 1)
	public Integer getSundayEnd() {
		return this.sundayEnd;
	}

	public void setSundayEnd(Integer sundayEnd) {
		this.sundayEnd = sundayEnd;
	}

	@JoinColumn(name = "user")
	@OneToOne(fetch=FetchType.LAZY)
	public User getUser() {
		return this.user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	@Column(name = "created_at", insertable=true, updatable=false)
	public Long getCreatedAt() {
		return this.createdAt;
	}

	public void setCreatedAt(Long createdAt) {
		this.createdAt = createdAt;
	}

	@Column(name = "updated_at", insertable=true, updatable=true)
	public Long getUpdatedAt() {
		return this.updatedAt;
	}

	public void setUpdatedAt(Long updatedAt) {
		this.updatedAt = updatedAt;
	}

	/**
	 * Used for updating.  This will get all the values from settings that are not null 
	 * and set them in this.  
	 * 
	 * @param settings object to do a "merge" of sorts with this.
	 */
	@Transient
	public void updateValuesFromOther(Settings settings) {
		// No real good way to do this but the long way...balls.
		
		Integer t = settings.getMondayStart();
		
		// Monday
		if (t != null) {
			mondayStart = t;
		}
		
		t = settings.getMondayEnd();
		
		if (t != null) {
			mondayEnd = t;
		}
		
		// Tuesday
		t = settings.getTuesdayStart();
		
		if (t != null) {
			tuesdayStart = t;
		}
		
		t = settings.getTuesdayEnd();
		
		if (t != null) {
			tuesdayEnd = t;
		}

		// Wednesday
		t = settings.getWednesdayStart();
		
		if (t != null) {
			wednesdayStart = t;
		}
		
		t = settings.getWednesdayEnd();
		
		if (t != null) {
			wednesdayEnd = t;
		}
		
		// Thursday
		t = settings.getThursdayStart();
		
		if (t != null) {
			thursdayStart = t;
		}
		
		t = settings.getThursdayEnd();
		
		if (t != null) {
			thursdayEnd = t;
		}

		// Friday
		t = settings.getFridayStart();
		
		if (t != null) {
			fridayStart = t;
		}
		
		t = settings.getFridayEnd();
		
		if (t != null) {
			fridayEnd = t;
		}
		
		// Saturday
		t = settings.getSaturdayStart();
		
		if (t != null) {
			saturdayStart = t;
		}
		
		t = settings.getSaturdayEnd();
		
		if (t != null) {
			saturdayEnd = t;
		}

		// Sunday
		t = settings.getSundayStart();
		
		if (t != null) {
			sundayStart = t;
		}
		
		t = settings.getSundayEnd();
		
		if (t != null) {
			sundayEnd = t;
		}
	}
	
	@Override
	public String toString() {
		StringBuilder builder = new StringBuilder();
		builder.append("Settings [settingsId=");
		builder.append(settingsId);
		builder.append(", mondayStart=");
		builder.append(mondayStart);
		builder.append(", mondayEnd=");
		builder.append(mondayEnd);
		builder.append(", tuesdayStart=");
		builder.append(tuesdayStart);
		builder.append(", tuesdayEnd=");
		builder.append(tuesdayEnd);
		builder.append(", wednesdayStart=");
		builder.append(wednesdayStart);
		builder.append(", wednesdayEnd=");
		builder.append(wednesdayEnd);
		builder.append(", thursdayStart=");
		builder.append(thursdayStart);
		builder.append(", thursdayEnd=");
		builder.append(thursdayEnd);
		builder.append(", fridayStart=");
		builder.append(fridayStart);
		builder.append(", fridayEnd=");
		builder.append(fridayEnd);
		builder.append(", saturdayStart=");
		builder.append(saturdayStart);
		builder.append(", saturdayEnd=");
		builder.append(saturdayEnd);
		builder.append(", sundayStart=");
		builder.append(sundayStart);
		builder.append(", sundayEnd=");
		builder.append(sundayEnd);
		builder.append(", user=");
		builder.append(user == null ? null : user.getUserId());
		builder.append(", createdAt=");
		builder.append(createdAt);
		builder.append(", updatedAt=");
		builder.append(updatedAt);
		builder.append("]");
		return builder.toString();
	}

}
